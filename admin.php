<?php
/**
 * Classe para gerenciar a interface administrativa do plugin.
 */
class WordPress_Grid_Accordion_Admin {

    /**
     * Construtor da classe.
     */
    public function __construct() {
        add_action( 'admin_menu', array( $this, 'add_admin_menu' ) );
        add_action( 'admin_init', array( $this, 'admin_init' ) );
    }

    /**
     * Adiciona o menu de administração.
     */
    public function add_admin_menu() {
        add_options_page(
            'WordPress Grid Accordion',
            'Grid Accordion',
            'manage_options',
            'wordpress-grid-accordion',
            array( $this, 'admin_page' )
        );
    }

    /**
     * Inicializa as configurações de administração.
     */
    public function admin_init() {
        register_setting( 'wordpress_grid_accordion_settings', 'wordpress_grid_accordion_settings' );

        add_settings_section(
            'wordpress_grid_accordion_section',
            'Configurações do Grid Accordion',
            array( $this, 'settings_section_callback' ),
            'wordpress_grid_accordion_settings'
        );

        add_settings_field(
            'default_animation_speed',
            'Velocidade da Animação (ms)',
            array( $this, 'animation_speed_callback' ),
            'wordpress_grid_accordion_settings',
            'wordpress_grid_accordion_section'
        );

        add_settings_field(
            'default_border_color',
            'Cor da Borda',
            array( $this, 'border_color_callback' ),
            'wordpress_grid_accordion_settings',
            'wordpress_grid_accordion_section'
        );
    }

    /**
     * Callback da seção de configurações.
     */
    public function settings_section_callback() {
        echo '<p>Configure as opções padrão para o plugin Grid Accordion.</p>';
    }

    /**
     * Callback para o campo de velocidade da animação.
     */
    public function animation_speed_callback() {
        $options = get_option( 'wordpress_grid_accordion_settings' );
        $value = isset( $options['default_animation_speed'] ) ? $options['default_animation_speed'] : '300';
        echo '<input type="number" name="wordpress_grid_accordion_settings[default_animation_speed]" value="' . esc_attr( $value ) . '" min="100" max="2000" />';
        echo '<p class="description">Velocidade da animação em milissegundos (padrão: 300ms).</p>';
    }

    /**
     * Callback para o campo de cor da borda.
     */
    public function border_color_callback() {
        $options = get_option( 'wordpress_grid_accordion_settings' );
        $value = isset( $options['default_border_color'] ) ? $options['default_border_color'] : '#cccccc';
        echo '<input type="color" name="wordpress_grid_accordion_settings[default_border_color]" value="' . esc_attr( $value ) . '" />';
        echo '<p class="description">Cor padrão da borda dos itens do acordeão.</p>';
    }

    /**
     * Renderiza a página de administração.
     */
    public function admin_page() {
        ?>
        <div class="wrap">
            <h1>WordPress Grid Accordion v1.1.0</h1>
            <form method="post" action="options.php">
                <?php
                settings_fields( 'wordpress_grid_accordion_settings' );
                do_settings_sections( 'wordpress_grid_accordion_settings' );
                submit_button();
                ?>
            </form>
            
            <div style="margin-top: 30px;">
                <h2>Como usar o plugin</h2>
                <p>Para usar o plugin, utilize o shortcode <code>[grid_accordion]</code> com os itens dentro:</p>
                
                <h3>Exemplo Básico:</h3>
                <pre><code>[grid_accordion id="meu-acordeao"]
[grid_accordion_item title="Título 1"]Conteúdo do primeiro item[/grid_accordion_item]
[grid_accordion_item title="Título 2"]Conteúdo do segundo item[/grid_accordion_item]
[grid_accordion_item title="Título 3"]Conteúdo do terceiro item[/grid_accordion_item]
[/grid_accordion]</code></pre>

                <h3>Exemplo com Imagem e Ícone:</h3>
                <pre><code>[grid_accordion id="servicos-com-imagem"]
[grid_accordion_item title="Desenvolvimento Web" image_url="https://exemplo.com/imagem1.jpg" icon="chevron_down"]Criamos sites modernos e responsivos.[/grid_accordion_item]
[grid_accordion_item title="Design Gráfico" image_url="https://exemplo.com/imagem2.jpg"]Nossa equipe de designers cria identidades visuais únicas.[/grid_accordion_item]
[grid_accordion_item title="Marketing Digital" content_id="123"]Conteúdo será carregado do post/página com ID 123[/grid_accordion_item]
[/grid_accordion]</code></pre>
                
                <h3>Parâmetros disponíveis para grid_accordion_item:</h3>
                <ul>
                    <li><strong>title</strong>: Título do item (obrigatório)</li>
                    <li><strong>image_url</strong>: URL da imagem a ser exibida acima do título (opcional)</li>
                    <li><strong>icon</strong>: Classe do ícone Font Awesome (padrão: chevron_down)</li>
                    <li><strong>content_id</strong>: ID de um post/página para usar como conteúdo (opcional)</li>
                </ul>

                <h3>Parâmetros disponíveis para grid_accordion:</h3>
                <ul>
                    <li><strong>id</strong>: ID único para o acordeão (opcional)</li>
                </ul>
                
                <h3>Características do plugin:</h3>
                <ul>
                    <li>Os itens são organizados em linhas de 3 elementos (33.33% cada)</li>
                    <li>O conteúdo expandido aparece abaixo de cada linha completa</li>
                    <li>Layout responsivo para dispositivos móveis</li>
                    <li>Animações suaves de abertura e fechamento</li>
                    <li>Suporte a imagens acima do título</li>
                    <li>Ícones Font Awesome com rotação ao expandir/colapsar</li>
                    <li>Carregamento de conteúdo de posts/páginas existentes</li>
                </ul>

                <h3>Novidades da versão 1.1.0:</h3>
                <ul>
                    <li>✅ Adicionado suporte a imagens acima do título</li>
                    <li>✅ Adicionado ícone chevron_down abaixo do título com rotação</li>
                    <li>✅ Possibilidade de usar conteúdo de posts/páginas via content_id</li>
                    <li>✅ Integração com Font Awesome para ícones</li>
                </ul>
            </div>
        </div>
        <?php
    }
}

// Inicializa a classe de administração se estivermos no admin
if ( is_admin() ) {
    new WordPress_Grid_Accordion_Admin();
}

