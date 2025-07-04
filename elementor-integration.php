<?php
/**
 * Classe para integração com o Elementor
 */
class WordPress_Grid_Accordion_Elementor {

    /**
     * Construtor da classe.
     */
    public function __construct() {
        add_action( 'elementor/widgets/widgets_registered', array( $this, 'register_widgets' ) );
        add_action( 'elementor/elements/categories_registered', array( $this, 'add_elementor_widget_categories' ) );
    }

    /**
     * Adiciona categoria personalizada para o widget
     */
    public function add_elementor_widget_categories( $elements_manager ) {
        $elements_manager->add_category(
            'grid-accordion',
            [
                'title' => esc_html__( 'Grid Accordion', 'wordpress-grid-accordion' ),
                'icon' => 'fa fa-plug',
            ]
        );
    }

    /**
     * Registra os widgets do Elementor
     */
    public function register_widgets() {
        // Incluir a classe do widget
        require_once plugin_dir_path( __FILE__ ) . 'elementor-widget.php';
        
        // Registrar o widget
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \WordPress_Grid_Accordion_Widget() );
    }
}

// Inicializar apenas se o Elementor estiver ativo
if ( did_action( 'elementor/loaded' ) ) {
    new WordPress_Grid_Accordion_Elementor();
}

