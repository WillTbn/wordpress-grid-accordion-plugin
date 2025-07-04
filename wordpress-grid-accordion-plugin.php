<?php
/**
 * Plugin Name: WordPress Grid Accordion
 * Plugin URI:  https://github.com/WillTbn/wordpress-grid-accordion-plugin
 * Description: Um plugin de acordeão em grade personalizado para WordPress.
 * Version:     1.5.0
 * Author:      Jorge Nunes
 * Author URI:  https://jorgefsdeveloper.bucardcode.com.br/
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: wordpress-grid-accordion
 * Domain Path: /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// Incluir a classe de administração
require_once plugin_dir_path( __FILE__ ) . 'admin.php';

// Incluir a integração com Elementor
require_once plugin_dir_path( __FILE__ ) . 'elementor-integration.php';

/**
 * Classe principal do plugin WordPress Grid Accordion.
 */
class WordPress_Grid_Accordion {

    /**
     * Temas disponíveis
     */
    private $available_themes = array(
        'default' => 'Padrão',
        'modern' => 'Moderno',
        'minimal' => 'Minimalista',
        'corporate' => 'Corporativo',
        'creative' => 'Criativo'
    );

    /**
     * Construtor da classe.
     */
    public function __construct() {
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ), 15 ); // Prioridade mais alta
        add_shortcode( 'grid_accordion', array( $this, 'render_grid_accordion' ) );
    }

    /**
     * Enfileira os scripts e estilos do plugin.
     */
    public function enqueue_scripts() {
        wp_enqueue_style( 'wordpress-grid-accordion-style', plugins_url( 'assets/css/style.css', __FILE__ ), array(), '1.5.0' );
        
        // Enfileirar Font Awesome apenas se não estiver já carregado
        if ( ! wp_style_is( 'font-awesome', 'enqueued' ) && ! wp_style_is( 'fontawesome', 'enqueued' ) ) {
            wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css', array(), '5.15.4' );
        }
        
        wp_enqueue_script( 'wordpress-grid-accordion-script', plugins_url( 'assets/js/script.js', __FILE__ ), array( 'jquery' ), '1.5.0', true );
    }

    /**
     * Enfileira o CSS do tema específico
     */
    public function enqueue_theme_style( $theme ) {
        if ( $theme && $theme !== 'default' && array_key_exists( $theme, $this->available_themes ) ) {
            wp_enqueue_style( 
                'wordpress-grid-accordion-theme-' . $theme, 
                plugins_url( 'assets/themes/' . $theme . '.css', __FILE__ ), 
                array( 'wordpress-grid-accordion-style' ), 
                '1.5.0' 
            );
        }
    }

    /**
     * Obtém os temas disponíveis
     */
    public function get_available_themes() {
        return $this->available_themes;
    }

    /**
     * Renderiza o shortcode do acordeão em grade.
     *
     * @param array $atts Atributos do shortcode.
     * @param string $content Conteúdo do shortcode.
     * @return string HTML do acordeão em grade.
     */
    public function render_grid_accordion( $atts, $content = null ) {
        $atts = shortcode_atts( array(
            'id' => '',
            'theme' => 'default', // Novo parâmetro para tema
        ), $atts, 'grid_accordion' );

        // Enfileirar o CSS do tema se necessário
        $this->enqueue_theme_style( $atts['theme'] );

        // Processar o conteúdo para extrair os itens do acordeão.
        // Adicionado suporte para image_url, icon e content_id
        preg_match_all( '/\[grid_accordion_item\s+title="(.*?)"(?:\s+image_url="(.*?)")?(?:\s+icon="(.*?)")?(?:\s+content_id="(.*?)")?\](.*?)\[\/grid_accordion_item\]/s', $content, $matches, PREG_SET_ORDER );

        // Adicionar classe do tema
        $theme_class = $atts['theme'] !== 'default' ? ' theme-' . esc_attr( $atts['theme'] ) : '';
        
        $output = '<div class="wordpress-grid-accordion' . $theme_class . '" id="' . esc_attr( $atts['id'] ) . '">';
        $output .= '<div class="grid-accordion-container">';
        
        $all_items_data = [];
        $item_count = 0;

        foreach ( $matches as $item ) {
            $title = $item[1];
            $image_url = isset($item[2]) ? $item[2] : '';
            $icon = isset($item[3]) ? $item[3] : 'fas fa-chevron-down'; // Padrão para chevron_down
            $content_id = isset($item[4]) ? $item[4] : '';
            $item_content = isset($item[5]) ? $item[5] : '';

            $item_id = 'grid-accordion-item-' . uniqid(); // Gerar um ID único para cada item

            // Se content_id for fornecido, buscar o conteúdo do post/página
            if ( ! empty( $content_id ) ) {
                $post_content = get_post_field( 'post_content', $content_id );
                if ( $post_content ) {
                    $item_content = $post_content; // Sobrescreve o conteúdo do shortcode se content_id for válido
                }
            }

            $all_items_data[] = [
                'id' => $item_id,
                'title' => $title,
                'image_url' => $image_url,
                'icon' => $icon,
                'content' => do_shortcode( $item_content )
            ];

            // Renderizar cada item individualmente
            $output .= '<div class="grid-accordion-item" data-item-id="' . esc_attr( $item_id ) . '" data-item-index="' . $item_count . '">';
            
            if ( ! empty( $image_url ) ) {
                $output .= '<img src="' . esc_url( $image_url ) . '" alt="' . esc_attr( $title ) . '" class="grid-accordion-image">';
            }
            
            $output .= '<h3 class="grid-accordion-title">' . esc_html( $title ) . '</h3>';
            $output .= '<span class="grid-accordion-icon ' . esc_attr( $icon ) . '"></span>'; // Ícone
            $output .= '</div>';
            
            // Adicionar wrapper de conteúdo imediatamente após cada item
            $output .= '<div class="grid-accordion-content-wrapper" data-item-id="' . esc_attr( $item_id ) . '" style="display: none;">';
            $output .= '<div class="grid-accordion-content">' . do_shortcode( $item_content ) . '</div>';
            $output .= '</div>';

            $item_count++;
        }

        $output .= '</div>'; // Fechar grid-accordion-container
        $output .= '</div>'; // Fechar wordpress-grid-accordion

        // Passar os dados dos itens para o JavaScript
        wp_localize_script( 'wordpress-grid-accordion-script', 'gridAccordionData_' . esc_attr( $atts['id'] ), $all_items_data );

        return $output;
    }
}

// Inicializa o plugin.
new WordPress_Grid_Accordion();

