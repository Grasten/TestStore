<?php


namespace Framework;


use Catalog\Model\CategoryRepository;

class PageResult implements ResultInterface
{

    /**
     * @var string
     */
    private $contentTemplate;
    /**
     * @var array
     */
    private $vars;
    /**
     * @var string
     */
    private $title;
    /**
     * @var string
     */
    private $head;

    protected $layoutTemplate = '/Index/view/templates/layout.phtml';

    public function setVars(array $vars):void
    {
        $this->vars = $vars;
    }

    public function setTitle(string $title):void
    {
        $this->title = $title;
    }

    public function setHtmlHead(string $head):void
    {
        $this->head = $head;
    }
    
    public function send(): void
    {
        $categoryRepository = new CategoryRepository();
        $categories = $categoryRepository->getCategories();
        ob_start();
        extract($this->vars, EXTR_SKIP);
        include BP . $this->contentTemplate;
        $pageContent = ob_get_clean();
        $title = $this->title;
        $head = $this->head;
        include BP . $this->layoutTemplate;
    }

    public function setContentTemplate(string $template)
    {
        $this->contentTemplate = $template;
    }

}