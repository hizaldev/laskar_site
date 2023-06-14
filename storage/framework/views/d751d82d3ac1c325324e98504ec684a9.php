<?php $__env->startSection('content'); ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="container-fluid px-5">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header"><strong>Master Data Golongan Darah</strong></div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-sm table-bordered table-hover w-100 table table-striped border datatable">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th> 
                                            <input type="text" class="form-control filter-input form-control-sm" placeholder="Search Data Golongan Darah" data-column="1">
                                        </th>
                                        <th> 
                                            <input type="text" class="form-control filter-input form-control-sm" placeholder="Search Keterangan" data-column="2">
                                        </th>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('master_golongan_darah-edit')): ?>
                                            <th class="py-2"></th>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('master_golongan_darah-delete')): ?>
                                            <th class="py-2"></th>
                                        <?php endif; ?>
                                    </tr>
                                    <tr>
                                        <th class="py-2">Id</th>
                                        <th class="py-2">Golongan Darah</th>
                                        <th class="py-2">Keterangan</th>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('master_golongan_darah-edit')): ?>
                                            <th class="py-2"></th>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('master_golongan_darah-delete')): ?>
                                            <th class="py-2"></th>
                                        <?php endif; ?>
                                    </tr>
                                    
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.c  ontent-wrapper -->
    
<?php $__env->stopSection(); ?>

<?php $__env->startPush('addon-style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/jquery.dataTables.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/buttons.bootstrap5.min.css')); ?>">
    
<?php $__env->stopPush(); ?>

<?php $__env->startPush('addon-script'); ?>
   <!-- Bootstrap 4 -->
    
    <!-- DataTables  & Plugins -->
    <script src="<?php echo e(asset('js/jquery-3.5.1.js')); ?>"></script>
    <script src="<?php echo e(asset('js/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/dataTables.bootstrap5.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/dataTables.buttons.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/buttons.bootstrap5.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/jszip.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/buttons.html5.min.js')); ?>"></script>
    
    <!-- Page specific script -->
    <script>
        var datatables = $('#example').DataTable({
            processing : true,
            serverSide  : true,
            ordering : true,
            sDom: 'Blrtip',
            ajax: {
                url: '<?php echo url()->current(); ?>'
            },
            columns : [
                { data: 'DT_RowIndex', 'orderable': false, 'searchable': false, width: '5%' },
                {data: 'golongan_darah', name: 'golongan_darah'},
                {data: 'description', name: 'description'},
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('master_golongan_darah-edit')): ?>
                    {
                        data: 'edit', 
                        name: 'edit',
                        orderable: false,
                        searchable: false,
                        width: '1%'
                    },
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('master_golongan_darah-delete')): ?>
                    {
                        data: 'delete', 
                        name: 'delete',
                        orderable: false,
                        searchable: false,
                        width: '1%'
                    },
                <?php endif; ?>
               
   
            ],
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100,  "All"]],
            buttons : [ 
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('master_golongan_darah-create')): ?>
                    {
                        text: "<i class='fa-solid fa-plus'></i>",
                        className: 'btn btn-primary mb-4 mr-2 text-white',
                        action: function ( e, dt, button, config ) {
                            window.location = '<?php echo e(route('type_bloods.create')); ?>';
                        }        
                    },
                <?php endif; ?>
                {
                    extend : 'excelHtml5',
                    text : "<i class='fa-regular fa-file-excel'></i>",
                    className: 'btn btn-success mb-4',
                } 
            ]
        });

        $('.filter-input').keyup(function(){
            datatables.column($(this).data('column'))
            .search($(this).val())
            .draw();
        });
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/alfbriatna/sites/project/laskar_site/resources/views/master/type_blood/index.blade.php ENDPATH**/ ?>