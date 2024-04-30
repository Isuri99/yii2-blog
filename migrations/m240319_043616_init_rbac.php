<?php

use yii\db\Migration;

/**
 * Class m240319_043616_init_rbac
 */
class m240319_043616_init_rbac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $auth = Yii::$app->authManager;

        //add "createPost" permission
        $createPost = $auth->createPermission('createPost');
        $createPost ->description = 'Create a post';
        $auth->add($createPost);

        //add 'updatePost' permission
        $updatePost = $auth->createPermission('updatePost');
        $updatePost->description= 'Update Post';
        $auth->add($updatePost);

        //add 'deletePost' permission
        $deletePost = $auth->createPermission('deletePost');
        $deletePost ->description = 'Delete Post';
        $auth->add($deletePost);

        //add "author" role and give this role "createPost" permission
        $author = $auth->createRole('author');
        $auth->add($author);
        $auth->addChild($author, $createPost);

        //add "editor" role and give this role 'createPost' and 'updatePost' permissions
        $editor = $auth->createRole('editor');
        $auth->add($editor);
        $auth->addChild($editor, $createPost);
        $auth->addChild($editor, $updatePost);

        //add "admin" role and give this role 'deletePost' permission
        //as well as the permission of the 'editor' role
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $deletePost);
        $auth->addChild($admin, $editor);

        $auth = Yii::$app->authManager;
        //rules
        $rule = new app\rbac\AuthorRule();
        $auth->add($rule);



// add the "updateOwnPost" permission and associate the rule with it.
        $updateOwnPost = $auth->createPermission('updateOwnPost');
        $updateOwnPost->description = 'Update own post';
        $updateOwnPost->ruleName = $rule->name;
        $auth->add($updateOwnPost);

// "updateOwnPost" will be used from "updatePost"

        $auth->addChild($updateOwnPost, $updatePost);

// allow "author" to update their own posts
        $auth->addChild($author, $updateOwnPost);


        $deleteOwnPost = $auth->createPermission('deleteOwnPost');
        $deleteOwnPost->description = 'Delete Own Post';
        $deleteOwnPost->ruleName=$rule->name;
        $auth->add($deleteOwnPost);

        $deletePost=$auth->getPermission('deletePost');
        $auth->addChild($deleteOwnPost, $deletePost);

        $author= $auth->getRole('author');
        $auth->addChild($author, $deleteOwnPost);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $auth = Yii::$app->authManager;

        $auth->removeAll();
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240319_043616_init_rbac cannot be reverted.\n";

        return false;
    }
    */
}
