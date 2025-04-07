<?= $this->extend('layout/dashmenu') ?>

<?= $this->section('content') ?>


<div class="container-fluid h-100">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-light">
            <h2>Liste des Produits </h2>
        </h6>
        <a href="#" class="btn btn-success btn-icon-split" data-toggle="modal" data-target="#addproduit">
            <span class="icon text-white-50"><i class="fas fa-plus"></i></span>
            <span class="text">Ajouter</span>
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nom Produit</th>
                        <th>Description</th>
                        <th>Prix</th>
                        <th>Stock</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tfoot class='d-none'>
                    <tr>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Telepnone</th>
                        <th>Adresse</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                        foreach ($produits as $produit) {
                        ?>
                    <tr class="justify-center" id="<?= $produit['id_produit']; ?>">
                        <td><?= $produit['nom_produit']; ?></td>
                        <td><?= $produit['description']; ?></td>
                        <td><?= $produit['prix']; ?></td>
                        <td><?= $produit['stock']; ?></td>
                        <td>
                            <button
                                onclick="charge_data_for_modal('<?= base_url('produit/editer/' . $produit['id_produit']) ?>','updateBus','updateBusModal')"
                                class="btn btn-primary btnEdit"><i class="fa fa-edit"></i></button>

                            <button
                                onclick="delete_entitie_ajax('<?= base_url('produit/delete/' . $produit['id_produit']) ?>')"
                                class="btn btn-danger Delete"><i class="fa fa-trash-alt"></i></button>
                        </td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal -->
<div class="modal fade" id="addproduit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nouveau Produit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="needs-validation" novalidate action="<?= site_url('/produit/store') ?>" method="post" id="createproduit">
      <div class="modal-body">
        <div class="form-group">
            <label for="name">Nom Produit:</label>
            <input type="text" class="form-control" id="nom" placeholder="Entrez le nom du produit" name="nom">
            <div class="valid-tooltip">
                Looks good!
            </div>
        </div>
        <div class="form-group">
            <label for="capacite">Description :</label>
            <input type="text" class="form-control" id="description" placeholder="Entrez la description du produit" name="description" >
        </div>
        <div class="form-group">
            <label for="">Prix:</label>
            <input type="text" class="form-control" id="prix" placeholder="Entrez le Prix" name="prix" >
        </div>
        <div class="form-group">
            <label for="">Stock:</label>
            <input type="text" class="form-control" id="stock" placeholder="Stock" name="stock" >
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
        <button type="submit" class="btn btn-success">Ajouter</button>
      </div>
      </form>
    </div>
  </div>
</div>


<div class="modal fade" name="updateBusModal" id="updateBusModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Mise à jour</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="needs-validation" novalidate action="<?= site_url('/bus/update') ?>" method="post" id="updateBus">
      <div class="modal-body">
        <div class="form-group">
        <input type="hidden" name="id_bus" id="id_bus" />

            <label for="name">Code Bus :</label>
            <input type="text" class="form-control" id="code_bus" placeholder="Entrez le code bus" name="code_bus">
            <div class="valid-tooltip">
                Looks good!
            </div>
        </div>
        <div class="form-group">
            <input type="file" class="form-control" id="image_bus" name="image_bus" >
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
        <button type="submit" class="btn btn-success">Update</button>
      </div>
      </form>
    </div>
  </div>
</div> 




<?= $this->endSection() ?>