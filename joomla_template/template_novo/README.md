# Template Terracap 2026 — "Eixos e Curvas"

Template para **Joomla 3.10.11** com o redesign do portal Terracap, convertido do protótipo
estático (`index.html`, `terracap.css`, `terracap.js`) e baseado no documento de conceito
*Terracap — Eixos e Curvas: Conceito e Design*. A estrutura Joomla (posições, helper,
overrides) foi herdada do template atual `onepageterracap2019` para que o conteúdo
existente do site continue funcionando.

## Instalação

O nome interno do template é **`terracap2026`**.

1. **Via instalador (recomendado):** compacte o conteúdo desta pasta em um `.zip`
   (o arquivo `templateDetails.xml` deve ficar na raiz do zip) e instale em
   *Extensões → Gerenciar → Instalar*. O Joomla criará `templates/terracap2026/`.
2. **Via cópia manual:** copie esta pasta para `templates/terracap2026/`
   (renomeie a pasta — o nome precisa bater com o `<name>` do XML) e use
   *Extensões → Gerenciar → Descobrir*.
3. Defina o template como padrão em *Extensões → Templates → Estilos*.

## Posições de módulo (mesmas do template atual)

| Posição | Uso no novo layout |
|---|---|
| `menu-principal` | Navegação do cabeçalho. Por padrão exibe o mega menu estático do protótipo; habilite o módulo em *Conteúdo*. |
| `super-banner` | Hero da home. Por padrão exibe o hero estático do protótipo; habilite o módulo em *Conteúdo*. |
| `pagina-inicial` | Seções da home (chrome `paginaInicial` gera `<section id="..."><div class="container">`, compatível com o novo CSS). Por padrão exibe a home estática completa do protótipo. |
| `trilha-navegacao` | Breadcrumbs nas páginas internas. |
| `internas-topo`, `internas-direita`, `internas-rodape` | Colunas das páginas internas (mesma lógica de prefixo por página do template atual: `<prefixo>-topo`, `<prefixo>-direita`, `<prefixo>-rodape`). |
| `pagina-interna-capa` | Páginas internas de capa (com_blankcomponent). |
| `rodape-1`, `rodape-2`, `rodape-3` | Colunas do rodapé. Por padrão exibe as colunas estáticas do protótipo. |
| `debug` | Depuração. |

### Módulos herdados x conteúdo estático

Os módulos do site atual foram construídos para o CSS/JS do template antigo
(`style.css`, `mega-menu.js`, swiper) e **quebram o layout** se renderizados dentro do
novo template sem adaptação. Por isso, na aba *Conteúdo* dos parâmetros do template,
cada área começa usando o **conteúdo estático do protótipo**:

- *Menu: usar módulo 'menu-principal'* — padrão **Não**
- *Hero: usar módulo 'super-banner'* — padrão **Não**
- *Home: usar módulos 'pagina-inicial'* — padrão **Não**
- *Rodapé: usar módulos 'rodape-1/2/3'* — padrão **Não**

Migre os módulos ao novo estilo um a um e vá ligando as chaves correspondentes.

> Dica: as caixas escuras com "Position/Style" que aparecem sobre a página são o modo
> *pré-visualização de posições* do Joomla (`?tp=1`). Acesse o site sem `?tp=1`
> (ou desative em *Extensões → Templates → Opções → Visualizar posições*) para ver o
> layout real.

## Parâmetros do template

- **Cabeçalho:** logotipo, URL de Serviços Online, código Google Analytics.
- **Rodapé:** telefone, SAC, endereço, horário, ocultar endereço.
- **Avançado:** URL do chat on-line (botão flutuante) e opção de carregar o
  `bootstrap.min.css` nas páginas internas (ligado por padrão — os overrides herdados
  em `html/` dependem do Bootstrap; desligue quando forem migrados ao novo estilo).

## Estrutura

- `index.php` — layout principal (home + internas), com fallbacks estáticos do protótipo.
- `component.php` / `error.php` — layouts de modal e de erro no novo estilo.
- `helper.php` — classe `TmplHelper` herdada do template atual (usada também pelos overrides).
- `css/terracap.css` — folha de estilo do redesign (tokens "Eixos e Curvas").
- `css/interno.css` — complementos para páginas internas e elementos nativos do Joomla
  (breadcrumb, mensagens, paginação, formulários, artigos).
- `css/bootstrap.min.css` — carregado só nas internas, para compatibilidade dos overrides.
- `js/terracap.js` — interações do redesign (mega menu, busca, mapa do território,
  contadores, carrossel, newsletter), sem dependência de jQuery.
- `html/` — overrides de componentes e módulos herdados do template atual
  (com_biddings, com_directsales, com_content etc.) e chromes de módulo (`modules.php`).
- `img/`, `language/`, `favicon.ico`.

## Observações de migração

### Módulos com "layout alternativo" presos ao template antigo

Quando um módulo usa um layout alternativo que veio de um template, o Joomla grava o
parâmetro como `nome-do-template:layout` — ex.: `onepageterracap2019:compre-imoveis-aba` —
e **continua carregando o layout daquele template mesmo com o terracap2026 ativo**.
É por isso que páginas como *Compre Imóveis* podem seguir exibindo o visual antigo
(abas amarelas) depois da troca de template.

Para migrar, há duas opções:

1. **Pelo admin (módulo a módulo):** *Extensões → Módulos → (módulo) → aba Avançado →
   Layout Alternativo* — escolha o layout de mesmo nome listado sob **terracap2026**
   e salve. Módulos tipicamente afetados: mod_auctions / mod_compreimoveis
   (`compre-imoveis-aba`), mod_biddings (`compre-imoveis-home`), mod_directsales
   (`default`, `capa-regularize`), mod_menu (`menu-contexto`, `megamenu` etc.),
   mod_artigos e mod_gallery.

2. **Por SQL (todos de uma vez, no banco do ambiente de testes):**

   ```sql
   UPDATE `#__modules`
      SET params = REPLACE(params, '"layout":"onepageterracap2019:', '"layout":"terracap2026:')
    WHERE params LIKE '%onepageterracap2019:%';
   ```

   Troque `#__` pelo prefixo real das tabelas e limpe o cache do Joomla depois.
   (Reversível trocando os nomes de lugar — o template antigo volta a valer.)

- As imagens da home estática apontam para URLs do portal atual
  (`www.terracap.df.gov.br`); ao publicar módulos nas posições, substitua pelo
  conteúdo gerenciado no Joomla.
- A busca do cabeçalho filtra os atalhos localmente (JS) e, ao enviar, usa o
  `com_search` do Joomla (`index.php?option=com_search`).
- Os overrides das principais páginas internas já foram migrados ao novo estilo
  (sem depender de Bootstrap/jQuery próprios): detalhe e listagem de Venda Direta
  (`com_directsales`), detalhe de licitação (`com_biddings`) e leilão (`com_auctions`),
  módulos de listagem (`mod_directsales/default` e `capa-regularize`,
  `mod_auctions/compre-imoveis-aba`, `mod_compreimoveis/compre-imoveis-aba`,
  `mod_biddings/compre-imoveis-home`), busca (`com_search`), FAQ (`com_faqs`),
  formulário de contato (`com_contact`) e artigo (`com_content/article`).
  Componentes reutilizáveis desses overrides (detalhe de edital, acordeão `<details>`,
  grade `lotes-grid` de cards `card-lote`, filtro por ano, barra de busca, cards de FAQ
  e resultados) estão documentados por seção em `css/interno.css`.
- Os demais overrides em `html/` ainda usam classes Bootstrap 4; a migração visual deles
  para o novo estilo pode continuar gradualmente, override a override.
- Nas páginas internas, o layout usa grid próprio (`.page-grid`), sem depender do
  Bootstrap. Páginas de capa (com_blankcomponent) que só têm módulos de links na
  posição `*-direita` exibem esses links como grade de cards no conteúdo principal
  (`.capa-links`), em vez de uma coluna lateral com o conteúdo vazio.
