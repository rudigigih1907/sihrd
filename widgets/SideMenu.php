<?php

namespace app\widgets;

use Exception;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Menu;

class SideMenu extends Menu {

    public $icon = "circle";

    public $nonCollapsedLink = '<a class="nav-link {active}" href="{url}">  <div class="sb-nav-link-icon">{icon}</div> {label}</a>';

    public $collapsedLink = '<a class="nav-link {active} collapsed" href="{url}" 
                                            data-toggle="collapse" 
                                            data-target="{data-target}" 
                                            aria-expanded= "false"
                                            aria-controls="{aria-controls}"> <div class="sb-nav-link-icon">{icon}</div> {label} 
                                        </a>';


    public $submenuTemplateOneLevel =
        "<div class='collapse {show}' 
                data-parent='#sidenavAccordion' 
                aria-labelledby='{id}'
                id = '{id}'
            >
                    <nav class='sb-sidenav-menu-nested nav'>
                       {items}
                    </nav>
        </div>";

    public $submenuTemplateMultiLevel =
        "<div class='collapse {show}' 
                data-parent='{data-parent}' 
                aria-labelledby='{id}'
                id = '{id}'
            >
                    <nav class='sb-sidenav-menu-nested nav accordion' id='{nav-id}'>
                       {items}
                    </nav>
        </div>";

    /**
     * @return string|void
     * @throws Exception
     */
    public function run() {
        if ($this->route === null && Yii::$app->controller !== null) {
            $this->route = Yii::$app->controller->getRoute();
        }
        if ($this->params === null) {
            $this->params = Yii::$app->request->getQueryParams();
        }
        $items = $this->normalizeItems($this->items, $hasActiveChild);

        if (!empty($items)) {
            $options = $this->options;
            $tag = ArrayHelper::remove($options, 'tag', 'ul');

            echo Html::tag($tag, $this->renderItems($items), $options);
        }
    }

    /**
     * @param array $items
     * @return string
     * @throws Exception
     */
    protected function renderItems($items) {

        $n = count($items);
        $lines = [];
        foreach ($items as $i => $item) {

            $options = array_merge($this->itemOptions, ArrayHelper::getValue($item, 'options', []));

            $tag = ArrayHelper::remove($options, 'tag', 'li');
            $class = [];

            if ($item['active']) {
                $class[] = $this->activeCssClass;
            }
            if ($i === 0 && $this->firstItemCssClass !== null) {
                $class[] = $this->firstItemCssClass;
            }
            if ($i === $n - 1 && $this->lastItemCssClass !== null) {
                $class[] = $this->lastItemCssClass;
            }

            Html::addCssClass($options, $class);

            $options['aria-expanded'] = false;
            $menu = $this->renderItem($item, $i);

            if (!empty($item['items'])) {

                $subItems = array_filter(array_column($item['items'],'items'));
                $iconClass = isset($item['icon']) ? $item['icon'] : $this->icon;
                if(empty($subItems)){
                    $submenuTemplate = ArrayHelper::getValue($item, 'submenuTemplate', $this->submenuTemplateOneLevel);
                    $menu .= strtr($submenuTemplate, [
                        '{id}' => "collapse" . str_replace(" ", "", $item['label']),
                        '{items}' => $this->renderItems($item['items']),
                        '{icon}' => '<i class=" fas fa-' . $iconClass . '"></i>',
                        '{show}' => in_array(true, ArrayHelper::getColumn($item['items'], 'active')) ? "show" : "",
                    ]);
                }else{
                    $submenuTemplate = ArrayHelper::getValue($item, 'submenuTemplate', $this->submenuTemplateMultiLevel);
                    $menu .= strtr($submenuTemplate, [
                        '{id}' => "collapse" . str_replace(" ", "", $item['label']),
                        '{items}' => $this->renderItems($item['items']),
                        '{icon}' => '<i class=" fas fa-' . $iconClass. '"></i>',
                        '{show}' => in_array(true, ArrayHelper::getColumn($item['items'], 'active')) ? "show" : "",
                        '{data-parent}' => "#sidenavAccordion" . str_replace(" ", "", $item['label']),
                        '{nav-id}' => "sidenavAccordion" . str_replace(" ", "", $item['label']),
                    ]);
                }
            }

            $lines[] = Html::tag($tag, $menu, $options);
        }

        return implode("\n", $lines);
    }


    /**
     * @param array $item
     * @param int $i
     * @return string
     * @throws Exception
     */
    protected function renderItem($item, $i = 0) {

        $iconClass = isset($item['icon']) ? $item['icon'] : $this->icon;

        if (isset($item['url'])) {

            // Link As Link to open Collapsed Item (Close div)
            if (isset($item['items'])) {

                $template = ArrayHelper::getValue($item, 'template', $this->collapsedLink);

                return strtr($template, [
                    '{url}' => Html::encode(Url::to($item['url'])),
                    '{label}' => $item['label'] . '<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>',
                    '{icon}' => '<i class=" fas fa-' . $iconClass . '"></i>',
                    '{data-target}' => "#collapse" . str_replace(" ", "", $item['label']),
                    '{aria-controls}' => "collapse" . str_replace(" ", "", $item['label']),
                    '{aria-expanded}' => "true",
                    '{active}' => $item['active'] == 1 ? "active" : "",
                ]);

            }

            $template = ArrayHelper::getValue($item, 'template', $this->nonCollapsedLink);
            return strtr($template, [
                '{url}' => Html::encode(Url::to($item['url'])),
                '{label}' => $item['label'],
                '{icon}' => '<i class=" fas fa-' . $iconClass. '"></i>',
                '{active}' => $item['active'] == 1 ? "active" : "",
            ]);

        }

        $template = ArrayHelper::getValue($item, 'template', $this->labelTemplate);
        return strtr($template, [
            $item['label'],
        ]);
    }
}