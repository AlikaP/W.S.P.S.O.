<ul class="sidebar-nav">
                        <li class="sidebar-brand">
                            <a class="brand" href="<?php echo site_url('mech/dashboard'); ?>"><?php echo $meta_title; ?></a>
                        </li>
                        <li>
                            <?php echo anchor('mech/my_profile', '<i class="icon-user"></i> Moj profil'); ?>
                        </li>
                        <li>
                            <?php echo anchor('login/log_out', '<i class="icon-off"></i> Odjava'); ?>
                        </li>
                        <li>
                             <?php echo anchor('mech/weapon', '<i class="icon-fire"></i> Oružja'); ?>
                        </li>
                        <li>
                            <?php echo anchor('mech/service', '<i class="icon-wrench"></i> Servisi'); ?>
                        </li>
                        <li>
                            <?php echo anchor('mech/about', '<i class="icon-info-sign"></i> O programu'); ?>
                        </li>
                   
                    </ul>