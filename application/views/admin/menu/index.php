<ul class="sidebar-nav">
                        <li class="sidebar-brand">
                            <a class="brand" href="<?php echo site_url('admin/dashboard'); ?>"><?php echo $meta_title; ?></a>
                        </li>
                        <li>
                            <?php echo anchor('admin/my_profile', '<i class="icon-user"></i> Moj profil'); ?>
                        </li>
                        <li>
                            <?php echo anchor('login/log_out', '<i class="icon-off"></i> Odjava'); ?>
                        </li>
                         <li>
                            <?php echo anchor('admin/status', '<i class="icon-briefcase"></i> Stanje sustava'); ?>
                        </li>
                        <li>
                            <?php echo anchor('admin/user', '<i class="icon-book"></i> Korisnici'); ?>
                        </li>
                        <li>
                             <?php echo anchor('admin/weapon', '<i class="icon-fire"></i> Oružja'); ?>
                        </li>
                        <li>
                            <?php echo anchor('admin/service', '<i class="icon-wrench"></i> Servisi'); ?>
                        </li>
                        <li>
                            <?php echo anchor('admin/about', '<i class="icon-info-sign"></i> O programu'); ?>
                        </li>
                   
                    </ul>