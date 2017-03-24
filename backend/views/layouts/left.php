<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/test.gif" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>超级管理员</p>

                <a href="#"><i class="fa fa-circle text-success"></i> 在线</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
		
		<?= dmstr\widgets\Menu::widget(
			[
				'options' => ['class' => 'sidebar-menu'],
				'items' => [
					['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
					['label' => 'Gii', 'icon' => 'fa fa-file-code-o', 'url' => ['/gii']],
					['label' => 'Debug', 'icon' => 'fa fa-dashboard', 'url' => ['/debug']],
                    /*增加跳转去用户管理*/
					['label' => '用户管理', 'icon' => 'fa fa-dashboard', 'url' => ['/user-backend']],
                    
                    /*路由菜单管理*/
					['label' => '路由菜单管理', 'icon' => 'fa fa-dashboard', 'url' => ['/admin/menu']],
                    
                    /*路由列表*/
					['label' => '路由列表', 'icon' => 'fa fa-dashboard', 'url' => ['/admin/route']],
					
					/*增加路由权限管理*/
					['label' => '增加路由权限', 'icon' => 'fa fa-dashboard', 'url' => ['/admin/permission']],
					
					/*增加路由权限管理*/
					['label' => '角色列表', 'icon' => 'fa fa-dashboard', 'url' => ['/admin/role']],
                    
                    
                    /*增加路由权限管理*/
					['label' => '目前用户权限', 'icon' => 'fa fa-dashboard', 'url' => ['/admin']],
                    
                    
					['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
					[
						'label' => 'Same tools',
						'icon' => 'fa fa-share',
						'url' => '#',
						'items' => [
							['label' => 'Gii', 'icon' => 'fa fa-file-code-o', 'url' => ['/gii'],],
							['label' => 'Debug', 'icon' => 'fa fa-dashboard', 'url' => ['/debug'],],
							[
								'label' => 'Level One',
								'icon' => 'fa fa-circle-o',
								'url' => '#',
								'items' => [
									['label' => 'Level Two', 'icon' => 'fa fa-circle-o', 'url' => '#',],
									[
										'label' => 'Level Two',
										'icon' => 'fa fa-circle-o',
										'url' => '#',
										'items' => [
											['label' => 'Level Three', 'icon' => 'fa fa-circle-o', 'url' => '#',],
											['label' => 'Level Three', 'icon' => 'fa fa-circle-o', 'url' => '#',],
										],
									],
								],
							],
						],
					],
				],
			]
		) ?>

    </section>

</aside>
