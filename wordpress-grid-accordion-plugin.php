<?php
/**
 * Plugin Name: WordPress Grid Accordion
 * Plugin URI:  https://example.com/wordpress-grid-accordion
 * Description: Um plugin de acordeão em grade personalizado para WordPress.
 * Version:     1.1.0
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

/**
 * Classe principal do plugin WordPress Grid Accordion.
 */
class WordPress_Grid_Accordion {

    /**
     * Construtor da classe.
     */
    public function __construct() {
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
        add_shortcode( 'grid_accordion', array( $this, 'render_grid_accordion' ) );
    }

    /**
     * Enfileira os scripts e estilos do plugin.
     */
    public function enqueue_scripts() {
        wp_enqueue_style( 'wordpress-grid-accordion-style', plugins_url( 'assets/css/style.css', __FILE__ ), array(), '1.1.0' );
        wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css', array(), '5.15.4' );
        wp_enqueue_script( 'wordpress-grid-accordion-script', plugins_url( 'assets/js/script.js', __FILE__ ), array( 'jquery' ), '1.1.0', true );
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
        ), $atts, 'grid_accordion' );

        // Processar o conteúdo para extrair os itens do acordeão.
        // Adicionado suporte para image_url, icon e content_id
        preg_match_all( '/\[grid_accordion_item\s+title="(.*?)"(?:\s+image_url="(.*?)")?(?:\s+icon="(.*?)")?(?:\s+content_id="(.*?)")?\](.*?)\[\/grid_accordion_item\]/s', $content, $matches, PREG_SET_ORDER );

        $output = '<div class="wordpress-grid-accordion" id="' . esc_attr( $atts['id'] ) . '">';
        $item_count = 0;
        $current_row_items = [];
        $all_items_data = [];

        foreach ( $matches as $item ) {
            $title = $item[1];
            $image_url = isset($item[2]) ? $item[2] : '';
            $icon = isset($item[3]) ? $item[3] : 'chevron_down'; // Padrão para chevron_down
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

            $current_row_items[] = [
                'id' => $item_id,
                'title' => $title,
                'image_url' => $image_url,
                'icon' => $icon
            ];

            $item_count++;

            if ( $item_count % 3 === 0 ) {
                $output .= '<div class="grid-accordion-row">';
                foreach ( $current_row_items as $row_item ) {
                    $output .= '<div class="grid-accordion-item" data-item-id="' . esc_attr( $row_item['id'] ) . '">';
                    if ( ! empty( $row_item['image_url'] ) ) {
                        $output .= '<img src="' . esc_url( $row_item['image_url'] ) . '" alt="' . esc_attr( $row_item['title'] ) . '" class="grid-accordion-image">';
                    }
                    $output .= '<h3 class="grid-accordion-title">' . esc_html( $row_item['title'] ) . '</h3>';
                    $output .= '<span class="grid-accordion-icon ' . esc_attr( $row_item['icon'] ) . '"></span>'; // Ícone
                    $output .= '</div>';
                }
                $output .= '</div>';
                $output .= '<div class="grid-accordion-content-wrapper" data-row-id="' . esc_attr( $atts['id'] ) . '-' . (floor(($item_count - 1) / 3)) . '"></div>';
                $current_row_items = [];
            }
        }

        // Adicionar os itens restantes se não formarem uma linha completa
        if ( ! empty( $current_row_items ) ) {
            $output .= '<div class="grid-accordion-row">';
            foreach ( $current_row_items as $row_item ) {
                $output .= '<div class="grid-accordion-item" data-item-id="' . esc_attr( $row_item['id'] ) . '">';
                if ( ! empty( $row_item['image_url'] ) ) {
                    $output .= '<img src="' . esc_url( $row_item['image_url'] ) . '" alt="' . esc_attr( $row_item['title'] ) . '" class="grid-accordion-image">';
                }
                $output .= '<h3 class="grid-accordion-title">' . esc_html( $row_item['title'] ) . '</h3>';
                $output .= '<span class="grid-accordion-icon ' . esc_attr( $row_item['icon'] ) . '"></span>'; // Ícone
                $output .= '</div>';
            }
            $output .= '</div>';
            $output .= '<div class="grid-accordion-content-wrapper" data-row-id="' . esc_attr( $atts['id'] ) . '-' . (floor(($item_count - 1) / 3)) . '"></div>';
        }

        $output .= '</div>';

        // Passar os dados dos itens para o JavaScript
        wp_localize_script( 'wordpress-grid-accordion-script', 'gridAccordionData', $all_items_data );

        return $output;
    }
}

// Inicializa o plugin.
new WordPress_Grid_Accordion();


