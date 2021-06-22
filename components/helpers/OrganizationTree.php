<?php

namespace app\components\helpers;

use rmrevin\yii\fontawesome\FAS;
use Yii;
use yii\helpers\Html;

class OrganizationTree {
    /**
     * @param array $elements
     * @param int $parentId
     * @return array
     */
    public static function buildTree(array $elements, $parentId = 0) {
        $branch = [];
        foreach ($elements as $element) {
            if ($element['parent_id'] == $parentId) {
                $children = self::buildTree($elements, $element['id']);
                if ($children) {
                    $element['children'] = $children;
                }
                $branch[] = $element;
            }
        }
        return $branch;
    }

    /**
     * @param $tree
     * @return string
     */
    public static function buildTreeOutAsHtmlUnOrderedList($tree) {
        $markup = "";

        foreach ($tree as $branch => $twig) {
            if (isset($twig['children'])) {
                $markup .=
                    '<li>' .
                    Html::tag('span',
                        $twig['nama'] . ' <br/> ' .
                        Html::a(FAS::icon(FAS::_PLUS_CIRCLE), ['struktur-organisasi/create-child-from-diagram', 'root_id' => Yii::$app->request->get('parent_id'), 'parent_id' => $twig['id'],], ['class' => 'text-primary']) . ' ' .
                        Html::a(FAS::icon(FAS::_PEN), ['struktur-organisasi/update-child-from-diagram', 'root_id' => Yii::$app->request->get('parent_id'), 'parent_id' => $twig['id'],], ['class' => 'text-secondary']) . ' ' .
                        Html::a(FAS::icon(FAS::_TRASH), ['struktur-organisasi/delete-child-from-diagram', 'root_id' => Yii::$app->request->get('parent_id'), 'parent_id' => $twig['id'],], [
                            'class' => 'text-danger',
                            'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                            'data-method' => 'post',
                        ]) . ' '
                        , ['class' => 'tf-nc']
                    ) . '' . self::buildTreeOutAsHtmlUnOrderedList($twig['children']) . '</li>';

            } else {
                $markup .= '<li>' .
                    Html::tag('span',
                        $twig['nama'] . ' <br/> ' .
                        Html::a(FAS::icon(FAS::_PLUS_CIRCLE), ['struktur-organisasi/create-child-from-diagram', 'root_id' => Yii::$app->request->get('parent_id'), 'parent_id' => $twig['id'],], ['class' => 'text-primary']) . ' ' .
                        Html::a(FAS::icon(FAS::_PEN), ['struktur-organisasi/update-child-from-diagram', 'root_id' => Yii::$app->request->get('parent_id'), 'parent_id' => $twig['id'],], ['class' => 'text-secondary']) . ' ' .
                        Html::a(FAS::icon(FAS::_TRASH), ['struktur-organisasi/delete-child-from-diagram', 'root_id' => Yii::$app->request->get('parent_id'),
                            'parent_id' => $twig['id'],], [
                            'class' => 'text-danger',
                            'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                            'data-method' => 'post',
                        ]) . ' '
                        , ['class' => 'tf-nc']) . '</li>';
            }
        }

        return "<ul>" . $markup . "</ul>";
    }

}