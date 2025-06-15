# Guia Completo de Instalação e Publicação do Plugin WordPress Grid Accordion v1.1.0

## Instalação do Plugin

### Método 1: Upload via Painel Administrativo (Recomendado)

1. **Acesse o painel administrativo** do seu site WordPress
2. Navegue até **Plugins > Adicionar Novo**
3. Clique no botão **Enviar Plugin** no topo da página
4. Clique em **Escolher arquivo** e selecione o arquivo `wordpress-grid-accordion-plugin-v1.1.0.zip`
5. Clique em **Instalar Agora**
6. Após a instalação, clique em **Ativar Plugin**

### Método 2: Upload via FTP

1. **Extraia o arquivo ZIP** em seu computador
2. **Conecte-se ao seu servidor** via FTP
3. **Navegue até a pasta** `/wp-content/plugins/` do seu site WordPress
4. **Faça upload da pasta** `wordpress-grid-accordion-plugin` para o diretório plugins
5. **Acesse o painel administrativo** do WordPress
6. Vá para **Plugins > Plugins Instalados**
7. **Ative o plugin** "WordPress Grid Accordion"

## Novidades da Versão 1.1.0

### ✅ Suporte a Imagens
- Adicione imagens acima do título usando o parâmetro `image_url`
- Imagens responsivas que se adaptam ao container
- Suporte a qualquer formato de imagem web (JPG, PNG, WebP, SVG)

### ✅ Ícone Chevron com Animação
- Ícone chevron_down abaixo do título por padrão
- Rotação de 180° quando o item é expandido
- Integração automática com Font Awesome 5.15.4
- Possibilidade de personalizar o ícone

### ✅ Carregamento de Conteúdo Dinâmico
- Use conteúdo de posts/páginas existentes com `content_id`
- Processamento automático de shortcodes no conteúdo carregado
- Ideal para FAQs dinâmicos e conteúdo reutilizável

## Como Usar o Plugin Atualizado

### Shortcode Básico (Compatível com v1.0.0)

```
[grid_accordion id="exemplo"]
[grid_accordion_item title="Primeiro Item"]Conteúdo do primeiro item[/grid_accordion_item]
[grid_accordion_item title="Segundo Item"]Conteúdo do segundo item[/grid_accordion_item]
[grid_accordion_item title="Terceiro Item"]Conteúdo do terceiro item[/grid_accordion_item]
[/grid_accordion]
```

### Shortcode com Imagens

```
[grid_accordion id="servicos-visuais"]
[grid_accordion_item title="Desenvolvimento Web" image_url="https://exemplo.com/images/web-dev.jpg"]
Criamos sites modernos e responsivos usando as melhores tecnologias do mercado.
Nossa equipe especializada trabalha com HTML5, CSS3, JavaScript e frameworks modernos.
[/grid_accordion_item]

[grid_accordion_item title="Design Gráfico" image_url="https://exemplo.com/images/design.jpg"]
Nossa equipe de designers cria identidades visuais únicas para sua marca.
Trabalhamos com logotipos, materiais impressos e design digital.
[/grid_accordion_item]

[grid_accordion_item title="Marketing Digital" image_url="https://exemplo.com/images/marketing.jpg"]
Estratégias completas para aumentar sua presença online e gerar mais vendas.
SEO, redes sociais, campanhas pagas e análise de resultados.
[/grid_accordion_item]
[/grid_accordion]
```

### Shortcode com Conteúdo de Posts/Páginas

```
[grid_accordion id="faq-dinamico"]
[grid_accordion_item title="Como funciona o suporte?" content_id="123"]
Este conteúdo será substituído pelo conteúdo do post com ID 123
[/grid_accordion_item]

[grid_accordion_item title="Quais são os preços?" content_id="124"]
Conteúdo será carregado do post com ID 124
[/grid_accordion_item]

[grid_accordion_item title="Política de reembolso" content_id="125" image_url="https://exemplo.com/policy.jpg"]
Combina imagem com conteúdo dinâmico do post ID 125
[/grid_accordion_item]
[/grid_accordion]
```

### Shortcode Completo com Todas as Funcionalidades

```
[grid_accordion id="portfolio-completo"]
[grid_accordion_item title="Projeto Web Avançado" image_url="https://exemplo.com/projeto1.jpg" icon="fas fa-code" content_id="200"]
Conteúdo será carregado do post ID 200
[/grid_accordion_item]

[grid_accordion_item title="Design Responsivo" image_url="https://exemplo.com/projeto2.jpg" icon="fas fa-mobile-alt"]
Desenvolvimento de interfaces responsivas que funcionam perfeitamente em todos os dispositivos.
Utilizamos as melhores práticas de UX/UI design.
[/grid_accordion_item]

[grid_accordion_item title="E-commerce Personalizado" image_url="https://exemplo.com/projeto3.jpg"]
Lojas virtuais completas com integração de pagamento, gestão de estoque e relatórios avançados.
[/grid_accordion_item]
[/grid_accordion]
```

## Parâmetros Disponíveis

### Para `[grid_accordion]`
- **id**: ID único para o acordeão (opcional, mas recomendado)

### Para `[grid_accordion_item]`
- **title**: Título do item (obrigatório)
- **image_url**: URL da imagem a ser exibida acima do título (opcional)
- **icon**: Classe do ícone Font Awesome (padrão: chevron_down)
- **content_id**: ID de um post/página para usar como conteúdo (opcional)

## Configurações do Plugin

Após a instalação, você encontrará as configurações do plugin em:
**Configurações > Grid Accordion**

### Opções Disponíveis:

- **Velocidade da Animação**: Controla a velocidade das animações (100-2000ms)
- **Cor da Borda**: Define a cor padrão das bordas dos itens

### Novidades na Interface Administrativa v1.1.0:

- Exemplos atualizados com as novas funcionalidades
- Documentação completa dos novos parâmetros
- Guia de migração da versão anterior

## Migração da v1.0.0 para v1.1.0

### Compatibilidade Total
A versão 1.1.0 é 100% compatível com a versão anterior. Todos os shortcodes existentes continuarão funcionando sem modificações.

### Passos para Atualização:

1. **Backup Completo**: Faça backup do site antes da atualização
2. **Desative o Plugin**: Desative a versão antiga
3. **Substitua os Arquivos**: Faça upload da nova versão
4. **Ative o Plugin**: Ative a versão 1.1.0
5. **Teste**: Verifique se todos os acordeões existentes funcionam
6. **Implemente**: Adicione as novas funcionalidades gradualmente

### Exemplo de Migração Gradual:

**Antes (v1.0.0):**
```
[grid_accordion_item title="Serviço 1"]Descrição do serviço[/grid_accordion_item]
```

**Depois (v1.1.0) - Adicionando imagem:**
```
[grid_accordion_item title="Serviço 1" image_url="https://exemplo.com/servico1.jpg"]Descrição do serviço[/grid_accordion_item]
```

**Depois (v1.1.0) - Usando conteúdo dinâmico:**
```
[grid_accordion_item title="Serviço 1" image_url="https://exemplo.com/servico1.jpg" content_id="456"]Conteúdo será carregado do post 456[/grid_accordion_item]
```

## Características Técnicas Atualizadas

### Layout Responsivo Melhorado

- **Desktop**: 3 itens por linha (33.33% cada) com imagens centralizadas
- **Tablet** (≤768px): 2 itens por linha (50% cada)  
- **Mobile** (≤480px): 1 item por linha (100%)

### Funcionalidades v1.1.0

- **Imagens Responsivas**: Adaptação automática ao tamanho do container
- **Ícones Animados**: Rotação suave de 180° ao expandir/colapsar
- **Conteúdo Dinâmico**: Carregamento de posts/páginas via ID
- **Font Awesome**: Integração automática com biblioteca de ícones
- **Animações Aprimoradas**: Transições mais suaves e profissionais

## Personalização Avançada

### CSS Personalizado para Imagens

```css
/* Personalizar aparência das imagens */
.grid-accordion-image {
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    transition: all 0.3s ease;
}

.grid-accordion-item:hover .grid-accordion-image {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.2);
}
```

### CSS Personalizado para Ícones

```css
/* Personalizar ícones */
.grid-accordion-icon {
    color: #2196F3;
    font-size: 1.4em;
    text-shadow: 0 1px 2px rgba(0,0,0,0.1);
}

.grid-accordion-item.active .grid-accordion-icon {
    color: #FF9800;
}
```

### CSS para Layout Personalizado

```css
/* Layout com gradiente */
.grid-accordion-item {
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    border: none;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.grid-accordion-item.active {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    transform: translateY(-2px);
}
```

## Solução de Problemas v1.1.0

### Problemas com Imagens

**Imagens não carregam:**
- Verifique se a URL está correta e acessível
- Teste a URL diretamente no navegador
- Certifique-se de que não há bloqueios CORS
- Verifique se o servidor permite hotlinking

**Imagens muito grandes:**
```css
.grid-accordion-image {
    max-height: 150px;
    object-fit: cover;
}
```

### Problemas com Ícones

**Ícones não aparecem:**
- Verifique se o Font Awesome está carregando (F12 > Network)
- Teste com um tema padrão do WordPress
- Verifique conflitos com outros plugins

**Ícones personalizados:**
```
[grid_accordion_item title="Exemplo" icon="fas fa-star"]Conteúdo[/grid_accordion_item]
```

### Problemas com Conteúdo Dinâmico

**Content_id não funciona:**
- Verifique se o post/página existe e está publicado
- Confirme se o ID está correto
- Teste com um post simples primeiro

**Shortcodes não processam:**
- O plugin processa automaticamente shortcodes no conteúdo carregado
- Verifique se os shortcodes estão ativos no WordPress

## Publicação no Diretório Oficial do WordPress

### Preparação para Submissão v1.1.0

1. **Teste Completo**: Teste todas as funcionalidades em diferentes temas
2. **Documentação**: Mantenha README.md e documentação atualizados
3. **Código Limpo**: Siga WordPress Coding Standards
4. **Segurança**: Validação e sanitização de todos os inputs
5. **Performance**: Otimização de carregamento de assets

### Changelog para Submissão

```
= 1.1.0 =
* Added: Support for images above titles with image_url parameter
* Added: Chevron down icon with rotation animation
* Added: Dynamic content loading via content_id parameter
* Added: Font Awesome 5.15.4 integration
* Improved: Layout and responsiveness
* Updated: Admin interface with new examples
* Enhanced: Documentation with migration guide
* Fixed: Minor CSS issues in mobile view

= 1.0.0 =
* Initial release
* Grid accordion layout (3 items per row)
* Responsive design
* Basic admin interface
* Shortcode support
```

## Suporte e Manutenção

### Atualizações Futuras

- **v1.2.0**: Planejada integração com Elementor
- **v1.3.0**: Suporte a vídeos e áudio
- **v1.4.0**: Temas pré-definidos

### Suporte Técnico

Para suporte técnico ou dúvidas:
- **Email**: jlbnunes@live.com
- **Documentação**: Consulte README.md
- **GitHub**: [Link do repositório]
- **Fórum WordPress**: [Se publicado no diretório oficial]

## Conclusão

O WordPress Grid Accordion Plugin v1.1.0 representa uma evolução significativa, mantendo total compatibilidade com a versão anterior enquanto adiciona funcionalidades poderosas como suporte a imagens, ícones animados e carregamento dinâmico de conteúdo.

A atualização é segura e pode ser implementada gradualmente, permitindo que você aproveite as novas funcionalidades no seu próprio ritmo.

**Lembre-se sempre de fazer backup antes de qualquer atualização!**

