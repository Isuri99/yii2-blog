<?php

namespace app\rbac;

use yii\rbac\Rule;
use yii\rbac\Item;
use app\models\Article;

class AuthorRule extends Rule
{
    public $name = 'isAuthor';

    /**
     * @param string|int $user the user ID.
     * @param Item $item the role or permission that this rule is associated with
     * @param array $params parameters passed to ManagerInterface::checkAccess().
     * @return bool a value indicating whether the rule permits the role or permission it is associated with.
     */
    public function execute($user, $item, $params)
    {
        //var_dump($params);
        //exit();
        return isset($params['article']) ? $params['article']->created_by == $user : false;

}}
