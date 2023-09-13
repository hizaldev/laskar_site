<nav class="navbar navbar-expand-md navbar-dark bg-primary shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
            <img src="<?php echo e(asset('images/logo_bulat_laskar.png')); ?>" alt="Logo" width="40" height="40" class="d-inline-block">
            <?php echo e(config('app.name', 'Laravel')); ?>

        </a>
        <ul class="navbar-nav ms-auto">
            <!-- Authentication Links -->
            <?php if(auth()->guard()->guest()): ?>
            <div class="d-flex justify-content-evenly">
                
                    <li class="nav-item d-flex justify-content-evenly">
                        <?php if(Route::has('login')): ?>
                            <a class="nav-link" href="<?php echo e(url('signin')); ?>"><?php echo e(__('Login')); ?></a>
                        <?php endif; ?>
                    </li>
              
                
            </div>
                
            <?php else: ?>
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <?php echo e(Auth::user()->name); ?>

                        
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="<?php echo e(route('users.show', Auth::user()->user_id)); ?>"><i class="fa-solid fa-user"></i> Profile</a>
                        <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <i class="fa-solid fa-right-from-bracket"></i> 
                            <?php echo e(__('Logout')); ?>

                        </a>
                        

                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                            <?php echo csrf_field(); ?>
                        </form>
                    </div>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav><?php /**PATH /Users/alfbriatna/sites/project/laskar_site/resources/views/includes/header.blade.php ENDPATH**/ ?>