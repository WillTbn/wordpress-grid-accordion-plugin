<?php
/**
 * Widget do Elementor para Grid Accordion
 */
class WordPress_Grid_Accordion_Widget extends \Elementor\Widget_Base {

    /**
     * Obtém o nome do widget.
     */
    public function get_name() {
        return 'grid_accordion';
    }

    /**
     * Obtém o título do widget.
     */
    public function get_title() {
        return esc_html__( 'Grid Accordion', 'wordpress-grid-accordion' );
    }

    /**
     * Obtém o ícone do widget.
     */
    public function get_icon() {
        return 'eicon-accordion';
    }

    /**
     * Obtém as categorias do widget.
     */
    public function get_categories() {
        return [ 'grid-accordion' ];
    }

    /**
     * Obtém as palavras-chave do widget.
     */
    public function get_keywords() {
        return [ 'accordion', 'grid', 'toggle', 'tabs' ];
    }

    /**
     * Registra os controles do widget.
     */
    protected function register_controls() {
        
        // Seção de conteúdo
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Conteúdo', 'wordpress-grid-accordion' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        // Controle para os itens do acordeão
        $this->add_control(
            'accordion_items',
            [
                'label' => esc_html__( 'Itens do Acordeão', 'wordpress-grid-accordion' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'item_title',
                        'label' => esc_html__( 'Título', 'wordpress-grid-accordion' ),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => esc_html__( 'Título do Item', 'wordpress-grid-accordion' ),
                        'placeholder' => esc_html__( 'Digite o título do item', 'wordpress-grid-accordion' ),
                    ],
                    [
                        'name' => 'item_image',
                        'label' => esc_html__( 'Imagem', 'wordpress-grid-accordion' ),
                        'type' => \Elementor\Controls_Manager::MEDIA,
                        'default' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'name' => 'item_icon',
                        'label' => esc_html__( 'Ícone', 'wordpress-grid-accordion' ),
                        'type' => \Elementor\Controls_Manager::ICONS,
                        'default' => [
                            'value' => 'fas fa-chevron-down',
                            'library' => 'fa-solid',
                        ],
                    ],
                    [
                        'name' => 'content_type',
                        'label' => esc_html__( 'Tipo de Conteúdo', 'wordpress-grid-accordion' ),
                        'type' => \Elementor\Controls_Manager::SELECT,
                        'default' => 'custom',
                        'options' => [
                            'custom' => esc_html__( 'Conteúdo Personalizado', 'wordpress-grid-accordion' ),
                            'post' => esc_html__( 'Conteúdo de Post/Página', 'wordpress-grid-accordion' ),
                        ],
                    ],
                    [
                        'name' => 'item_content',
                        'label' => esc_html__( 'Conteúdo', 'wordpress-grid-accordion' ),
                        'type' => \Elementor\Controls_Manager::WYSIWYG,
                        'default' => esc_html__( 'Conteúdo do item do acordeão.', 'wordpress-grid-accordion' ),
                        'placeholder' => esc_html__( 'Digite o conteúdo do item', 'wordpress-grid-accordion' ),
                        'condition' => [
                            'content_type' => 'custom',
                        ],
                    ],
                    [
                        'name' => 'content_id',
                        'label' => esc_html__( 'ID do Post/Página', 'wordpress-grid-accordion' ),
                        'type' => \Elementor\Controls_Manager::NUMBER,
                        'placeholder' => esc_html__( 'Digite o ID do post ou página', 'wordpress-grid-accordion' ),
                        'condition' => [
                            'content_type' => 'post',
                        ],
                    ],
                ],
                'default' => [
                    [
                        'item_title' => esc_html__( 'Primeiro Item', 'wordpress-grid-accordion' ),
                        'item_content' => esc_html__( 'Conteúdo do primeiro item do acordeão.', 'wordpress-grid-accordion' ),
                    ],
                    [
                        'item_title' => esc_html__( 'Segundo Item', 'wordpress-grid-accordion' ),
                        'item_content' => esc_html__( 'Conteúdo do segundo item do acordeão.', 'wordpress-grid-accordion' ),
                    ],
                    [
                        'item_title' => esc_html__( 'Terceiro Item', 'wordpress-grid-accordion' ),
                        'item_content' => esc_html__( 'Conteúdo do terceiro item do acordeão.', 'wordpress-grid-accordion' ),
                    ],
                ],
                'title_field' => '{{{ item_title }}}',
            ]
        );

        $this->end_controls_section();

        // Seção de configurações
        $this->start_controls_section(
            'settings_section',
            [
                'label' => esc_html__( 'Configurações', 'wordpress-grid-accordion' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'accordion_id',
            [
                'label' => esc_html__( 'ID do Acordeão', 'wordpress-grid-accordion' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'elementor-accordion-' . uniqid(),
                'placeholder' => esc_html__( 'Digite um ID único', 'wordpress-grid-accordion' ),
            ]
        );

        $this->add_control(
            'accordion_theme',
            [
                'label' => esc_html__( 'Tema', 'wordpress-grid-accordion' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default' => esc_html__( 'Padrão', 'wordpress-grid-accordion' ),
                    'modern' => esc_html__( 'Moderno', 'wordpress-grid-accordion' ),
                    'minimal' => esc_html__( 'Minimalista', 'wordpress-grid-accordion' ),
                    'corporate' => esc_html__( 'Corporativo', 'wordpress-grid-accordion' ),
                    'creative' => esc_html__( 'Criativo', 'wordpress-grid-accordion' ),
                ],
                'description' => esc_html__( 'Escolha um tema pré-definido para o acordeão', 'wordpress-grid-accordion' ),
            ]
        );

        $this->end_controls_section();

        // Seção de estilo
        $this->start_controls_section(
            'style_section',
            [
                'label' => esc_html__( 'Estilo', 'wordpress-grid-accordion' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'item_background_color',
            [
                'label' => esc_html__( 'Cor de Fundo do Item', 'wordpress-grid-accordion' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .grid-accordion-item' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'item_border_color',
            [
                'label' => esc_html__( 'Cor da Borda', 'wordpress-grid-accordion' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .grid-accordion-item' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__( 'Tipografia do Título', 'wordpress-grid-accordion' ),
                'selector' => '{{WRAPPER}} .grid-accordion-title',
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Renderiza o widget no frontend.
     */
    protected function render() {
        $settings = $this->get_settings_for_display();

        if ( empty( $settings['accordion_items'] ) ) {
            return;
        }

        $accordion_id = ! empty( $settings['accordion_id'] ) ? $settings['accordion_id'] : 'elementor-accordion-' . uniqid();
        $theme = ! empty( $settings['accordion_theme'] ) ? $settings['accordion_theme'] : 'default';
        
        // Enfileirar CSS do tema se necessário
        if ( $theme && $theme !== 'default' ) {
            wp_enqueue_style( 
                'wordpress-grid-accordion-theme-' . $theme, 
                plugins_url( 'assets/themes/' . $theme . '.css', __FILE__ ), 
                array( 'wordpress-grid-accordion-style' ), 
                '1.4.0' 
            );
        }
        
        // Adicionar classe do tema
        $theme_class = $theme !== 'default' ? ' theme-' . esc_attr( $theme ) : '';

        echo '<div class="wordpress-grid-accordion' . $theme_class . '" id="' . esc_attr( $accordion_id ) . '">';

        $item_count = 0;
        $current_row_items = [];
        $all_items_data = [];

        foreach ( $settings['accordion_items'] as $index => $item ) {
            $item_id = 'grid-accordion-item-' . $index . '-' . uniqid();
            
            // Determinar o conteúdo
            $item_content = '';
            if ( $item['content_type'] === 'post' && ! empty( $item['content_id'] ) ) {
                $post_content = get_post_field( 'post_content', $item['content_id'] );
                $item_content = $post_content ? do_shortcode( $post_content ) : $item['item_content'];
            } else {
                $item_content = $item['item_content'];
            }

            // Preparar dados do item
            $all_items_data[] = [
                'id' => $item_id,
                'title' => $item['item_title'],
                'content' => $item_content
            ];

            $current_row_items[] = [
                'id' => $item_id,
                'title' => $item['item_title'],
                'image_url' => ! empty( $item['item_image']['url'] ) ? $item['item_image']['url'] : '',
                'icon' => $item['item_icon']
            ];

            $item_count++;

            // Renderizar linha completa (3 itens)
            if ( $item_count % 3 === 0 ) {
                $this->render_row( $current_row_items, $accordion_id, floor(($item_count - 1) / 3) );
                $current_row_items = [];
            }
        }

        // Renderizar itens restantes
        if ( ! empty( $current_row_items ) ) {
            $this->render_row( $current_row_items, $accordion_id, floor(($item_count - 1) / 3) );
        }

        echo '</div>';

        // Passar dados para JavaScript
        echo '<script>
        if (typeof gridAccordionData === "undefined") {
            var gridAccordionData = [];
        }
        gridAccordionData = gridAccordionData.concat(' . wp_json_encode( $all_items_data ) . ');
        </script>';
    }

    /**
     * Renderiza uma linha de itens
     */
    private function render_row( $row_items, $accordion_id, $row_index ) {
        echo '<div class="grid-accordion-row">';
        
        foreach ( $row_items as $item ) {
            echo '<div class="grid-accordion-item" data-item-id="' . esc_attr( $item['id'] ) . '">';
            
            // Imagem
            if ( ! empty( $item['image_url'] ) ) {
                echo '<img src="' . esc_url( $item['image_url'] ) . '" alt="' . esc_attr( $item['title'] ) . '" class="grid-accordion-image">';
            }
            
            // Título
            echo '<h3 class="grid-accordion-title">' . esc_html( $item['title'] ) . '</h3>';
            
            // Ícone
            if ( ! empty( $item['icon']['value'] ) ) {
                if ( $item['icon']['library'] === 'svg' ) {
                    echo '<span class="grid-accordion-icon">' . $item['icon']['value'] . '</span>';
                } else {
                    echo '<span class="grid-accordion-icon ' . esc_attr( $item['icon']['value'] ) . '"></span>';
                }
            } else {
                echo '<span class="grid-accordion-icon fas fa-chevron-down"></span>';
            }
            
            echo '</div>';
        }
        
        echo '</div>';
        echo '<div class="grid-accordion-content-wrapper" data-row-id="' . esc_attr( $accordion_id ) . '-' . $row_index . '"></div>';
    }

    /**
     * Renderiza o widget no editor do Elementor.
     */
    protected function content_template() {
        ?>
        <#
        if ( settings.accordion_items.length ) {
            var accordion_id = settings.accordion_id || 'elementor-accordion-' + Math.random().toString(36).substr(2, 9);
        #>
        <div class="wordpress-grid-accordion" id="{{ accordion_id }}">
            <# 
            var item_count = 0;
            var current_row_items = [];
            
            _.each( settings.accordion_items, function( item, index ) {
                var item_id = 'grid-accordion-item-' + index + '-' + Math.random().toString(36).substr(2, 9);
                
                current_row_items.push({
                    id: item_id,
                    title: item.item_title,
                    image_url: item.item_image.url || '',
                    icon: item.item_icon
                });
                
                item_count++;
                
                if ( item_count % 3 === 0 ) {
                    #>
                    <div class="grid-accordion-row">
                        <# _.each( current_row_items, function( row_item ) { #>
                        <div class="grid-accordion-item" data-item-id="{{ row_item.id }}">
                            <# if ( row_item.image_url ) { #>
                            <img src="{{ row_item.image_url }}" alt="{{ row_item.title }}" class="grid-accordion-image">
                            <# } #>
                            <h3 class="grid-accordion-title">{{ row_item.title }}</h3>
                            <# if ( row_item.icon.value ) { #>
                                <# if ( row_item.icon.library === 'svg' ) { #>
                                    <span class="grid-accordion-icon">{{{ row_item.icon.value }}}</span>
                                <# } else { #>
                                    <span class="grid-accordion-icon {{ row_item.icon.value }}"></span>
                                <# } #>
                            <# } else { #>
                                <span class="grid-accordion-icon fas fa-chevron-down"></span>
                            <# } #>
                        </div>
                        <# }); #>
                    </div>
                    <div class="grid-accordion-content-wrapper" data-row-id="{{ accordion_id }}-{{ Math.floor((item_count - 1) / 3) }}"></div>
                    <#
                    current_row_items = [];
                }
            });
            
            if ( current_row_items.length > 0 ) {
                #>
                <div class="grid-accordion-row">
                    <# _.each( current_row_items, function( row_item ) { #>
                    <div class="grid-accordion-item" data-item-id="{{ row_item.id }}">
                        <# if ( row_item.image_url ) { #>
                        <img src="{{ row_item.image_url }}" alt="{{ row_item.title }}" class="grid-accordion-image">
                        <# } #>
                        <h3 class="grid-accordion-title">{{ row_item.title }}</h3>
                        <# if ( row_item.icon.value ) { #>
                            <# if ( row_item.icon.library === 'svg' ) { #>
                                <span class="grid-accordion-icon">{{{ row_item.icon.value }}}</span>
                            <# } else { #>
                                <span class="grid-accordion-icon {{ row_item.icon.value }}"></span>
                            <# } #>
                        <# } else { #>
                            <span class="grid-accordion-icon fas fa-chevron-down"></span>
                        <# } #>
                    </div>
                    <# }); #>
                </div>
                <div class="grid-accordion-content-wrapper" data-row-id="{{ accordion_id }}-{{ Math.floor((item_count - 1) / 3) }}"></div>
                <#
            }
            #>
        </div>
        <# } #>
        <?php
    }
}

