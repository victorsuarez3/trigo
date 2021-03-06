    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?=$title_page?>
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Categorías</li>
      </ol>
    </section>
    <section class="content">
        <section class="row">
            <section class="col-md-12">
                <section class="box box-default">
                    <section class="box-header with-border">
                        <h3 class="box-title">Eliminar Categoríaa</h3>
                    </section>
                    <!-- /.box-header -->
                    <section class="box-body">
                        <section class="alert alert-warning">
                            <p>Realmente desea eliminar la categoría "<strong><?=$data->name?></strong>"?</p>
                        </section>
                        <form action="confirm" method="POST">
                            <section class="row">
                                <section class="col-md-offset-10 col-md-2">
                                    <section class="form-group">
                                        <button type="submit" class="btn btn-danger" name="id" value="<?=$data->id?>">Eliminar</button>
                                    </section>
                                </section>
                            </section>
                        </form>
                    </section>
                    <!-- /.box-body -->
                </section>
                <!-- /.box -->
            </section>
        </section>
    </section>