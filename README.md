# Grid Accordion Personalite Plugin v1.5.3 - Documentação Atualizada

## Visão Geral

O Grid Accordion Personalite é um plugin personalizado que cria um sistema de acordeão em grade, onde os itens são organizados em linhas de 3 elementos (33.33% cada) e o conteúdo expandido aparece abaixo de cada linha completa.

## Novidades da Versão 1.1.0

### ✅ Suporte a Imagens
- Agora é possível adicionar imagens acima do título de cada item
- As imagens são responsivas e se adaptam ao tamanho do container
- Parâmetro `image_url` no shortcode `grid_accordion_item`

### ✅ Ícone Chevron com Rotação
- Ícone chevron_down abaixo do título com animação de rotação
- Rotaciona 180° quando o item é expandido
- Integração com Font Awesome 5.15.4
- Parâmetro `icon` personalizável

### ✅ Carregamento de Conteúdo via ID
- Possibilidade de usar conteúdo de posts/páginas existentes
- Parâmetro `content_id` para referenciar posts por ID
- Processamento automático de shortcodes no conteúdo carregado

### ✅ Melhorias Visuais
- Layout centralizado para itens com imagens
- Espaçamento otimizado entre elementos
- Transições suaves para todos os elementos

## Como Usar

### Shortcode Básico (sem mudanças)

```
[grid_accordion id="exemplo"]
[grid_accordion_item title="Primeiro Item"]Conteúdo do primeiro item[/grid_accordion_item]
[grid_accordion_item title="Segundo Item"]Conteúdo do segundo item[/grid_accordion_item]
[grid_accordion_item title="Terceiro Item"]Conteúdo do terceiro item[/grid_accordion_item]
[/grid_accordion]
```

### Shortcode com Imagens

```
[grid_accordion id="servicos-com-imagem"]
[grid_accordion_item title="Desenvolvimento Web" image_url="https://exemplo.com/dev.jpg"]
Criamos sites modernos e responsivos usando as melhores tecnologias do mercado.
[/grid_accordion_item]
[grid_accordion_item title="Design Gráfico" image_url="https://exemplo.com/design.jpg"]
Nossa equipe de designers cria identidades visuais únicas para sua marca.
[/grid_accordion_item]
[grid_accordion_item title="Marketing Digital" image_url="https://exemplo.com/marketing.jpg"]
Estratégias completas para aumentar sua presença online e gerar mais vendas.
[/grid_accordion_item]
[/grid_accordion]
```

### Shortcode com Conteúdo de Posts/Páginas

```
[grid_accordion id="servicos-dinamicos"]
[grid_accordion_item title="Serviço 1" image_url="https://exemplo.com/servico1.jpg" content_id="123"]
Este conteúdo será substituído pelo conteúdo do post com ID 123
[/grid_accordion_item]
[grid_accordion_item title="Serviço 2" content_id="124"]
Conteúdo do post com ID 124
[/grid_accordion_item]
[grid_accordion_item title="Serviço 3" icon="fas fa-star"]
Conteúdo personalizado com ícone diferente
[/grid_accordion_item]
[/grid_accordion]
```

## Parâmetros Disponíveis

### Para `[grid_accordion]`
- **id**: ID único para o acordeão (opcional)

### Para `[grid_accordion_item]`
- **title**: Título do item (obrigatório)
- **image_url**: URL da imagem a ser exibida acima do título (opcional)
- **icon**: Classe do ícone Font Awesome (padrão: chevron_down)
- **content_id**: ID de um post/página para usar como conteúdo (opcional)

## Exemplos Práticos

### Exemplo 1: Portfólio de Serviços com Imagens

```
[grid_accordion id="portfolio"]
[grid_accordion_item title="Desenvolvimento Web" image_url="https://via.placeholder.com/300x200/4CAF50/FFFFFF?text=Web+Dev"]
<h4>Tecnologias Utilizadas:</h4>
<ul>
<li>HTML5, CSS3, JavaScript ES6+</li>
<li>React, Vue.js, Angular</li>
<li>Laravel, Node.js, Express</li>
<li>WordPress, Drupal</li>
</ul>
<p>Desenvolvemos sites responsivos e aplicações web modernas.</p>
[/grid_accordion_item]

[grid_accordion_item title="Design Gráfico" image_url="https://via.placeholder.com/300x200/2196F3/FFFFFF?text=Design"]
<h4>Serviços de Design:</h4>
<ul>
<li>Identidade Visual</li>
<li>Logotipos e Branding</li>
<li>Material Impresso</li>
<li>Design Digital</li>
</ul>
[/grid_accordion_item]

[grid_accordion_item title="Marketing Digital" image_url="https://via.placeholder.com/300x200/FF9800/FFFFFF?text=Marketing"]
<h4>Estratégias Digitais:</h4>
<ul>
<li>SEO e SEM</li>
<li>Redes Sociais</li>
<li>Email Marketing</li>
<li>Google Ads</li>
</ul>
[/grid_accordion_item]
[/grid_accordion]
```

### Exemplo 2: FAQ Dinâmico com Conteúdo de Posts

```
[grid_accordion id="faq-dinamico"]
[grid_accordion_item title="Como funciona o suporte?" content_id="456"]
Conteúdo será carregado do post ID 456
[/grid_accordion_item]
[grid_accordion_item title="Quais são os preços?" content_id="457"]
Conteúdo será carregado do post ID 457
[/grid_accordion_item]
[grid_accordion_item title="Como entrar em contato?" content_id="458"]
Conteúdo será carregado do post ID 458
[/grid_accordion_item]
[/grid_accordion]
```

## Personalização CSS

### Customizando Imagens

```css
.grid-accordion-image {
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
}

.grid-accordion-item:hover .grid-accordion-image {
    transform: scale(1.05);
}
```

### Customizando Ícones

```css
.grid-accordion-icon {
    color: #2196F3;
    font-size: 1.5em;
}

.grid-accordion-item.active .grid-accordion-icon {
    color: #FF9800;
}
```

### Customizando Layout

```css
.grid-accordion-item {
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.grid-accordion-item.active {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}
```

## Compatibilidade

- **WordPress**: 5.0 ou superior
- **PHP**: 7.4 ou superior
- **Font Awesome**: 5.15.4 (carregado automaticamente)
- **jQuery**: Incluído no WordPress
- **Navegadores**: Chrome, Firefox, Safari, Edge (versões modernas)

## Migração da v1.0.0 para v1.5.3

A versão 1.1.0 é totalmente compatível com a versão anterior. Todos os shortcodes existentes continuarão funcionando normalmente. As novas funcionalidades são opcionais e podem ser adicionadas gradualmente.

### Passos para Migração:

1. **Backup**: Faça backup do site antes da atualização
2. **Atualização**: Substitua os arquivos do plugin pela nova versão
3. **Teste**: Verifique se os acordeões existentes continuam funcionando
4. **Implementação**: Adicione as novas funcionalidades conforme necessário

## Solução de Problemas

### Imagens não aparecem
- Verifique se a URL da imagem está correta e acessível
- Certifique-se de que a imagem não está bloqueada por CORS
- Teste a URL da imagem diretamente no navegador

### Ícones não aparecem
- Verifique se o Font Awesome está carregando corretamente
- Teste em um tema padrão do WordPress para verificar conflitos
- Verifique o console do navegador para erros de carregamento

### Conteúdo via content_id não carrega
- Verifique se o ID do post/página existe
- Certifique-se de que o post está publicado
- Verifique as permissões de acesso ao conteúdo

## Changelog

### Versão 1.1.0
- ✅ Adicionado suporte a imagens acima do título
- ✅ Adicionado ícone chevron_down com rotação
- ✅ Implementado carregamento de conteúdo via content_id
- ✅ Integração com Font Awesome 5.15.4
- ✅ Melhorias no layout e responsividade
- ✅ Atualizada interface administrativa
- ✅ Documentação expandida com novos exemplos

### Versão 1.0.0
- 🎉 Lançamento inicial do plugin
- ✅ Sistema de acordeão em grade (3 itens por linha)
- ✅ Layout responsivo
- ✅ Interface administrativa básica
- ✅ Suporte a shortcodes

