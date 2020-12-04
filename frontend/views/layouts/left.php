<aside class="main-sidebar" style="box-shadow: 2px 2px 6px grey; ">

    <section class="sidebar">

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                  
					            ['label' => 'Home','icon' => 'home', 'url' => ['/site/index']],
                      
                      ['label' => 'Account Registration','icon' => ' fa-user-plus', 'url' => ['/registration/index']],
                      ['label' => 'Referral-Details','icon' => ' fa-users', 'url' => ['/referral-details/index']],
                      //['label' => 'User-Management','icon' => ' fa-user', 'url' => ['/member/index']],
                      ['label' => 'Pay Interest','icon' => 'usd', 'url' => ['/counter']],
                      ['label' => 'Check Investor','icon' => 'search', 'url' => ['/investor']],
                      ['label' => 'Reports','icon' => 'file', 'url' => ['/report']],
                      ['label' => 'User-Management','icon' => ' fa-user', 'url' => ['/member/index']],
                     
                      // ['label' => 'Reports','icon' => 'clipboard', 'url' => ['/report']],
                      // ['label' => 'Expenses','icon' => 'usd', 'url' => ['/stock-in']],
                     
                      //['label' => 'LEAVE APPLIED LIST','icon' => ' fa-circle-o', 'url' => ['/apply-leave/index']],

                       [
								'label' => 'Settings',
								'icon' => 'wrench',
								'items' => [
									           ['label' => 'Set Amount','url' => ['/amount']],
                             ['label' => 'Set Referral-Type', 'url' => ['/type']],
                             // ['label' => 'Set Offer', 'url' => ['/offer']],
                             // ['label' => 'Set Employees', 'url' => ['/employee']],
                             
					                
								],
								 // 'visible' => !Yii::$app->user->isGuest && Yii::$app->user->can('admin'),
						],
                        // 'visible' => !Yii::$app->user->isGuest && Yii::$app->user->can('admin'),
					
                ], // item
            ]
        ) ?>

    </section>

</aside>
<style>
    
</style>