<div class="form-row">
    <div class="form-group col-md-4">
        <label for="nom">Nom</label>
        <input type="text" class="form-control" id="nom" name="nom" value="<?= $usager->nom ?>">
    </div>

    <div class="form-group col-md-2">
        <label for="assurance-maladie">Ass. maladie</label>
        <input type="text" class="form-control assm text-uppercase" id="assurance-maladie" name="assurance_maladie"
               value="<?= $usager->assurance_maladie ?>">
    </div>

    <div class="form-group col-md-2">
        <label for="telephone">Téléphone</label>
        <input type="text" class="form-control phone" id="telephone" name="telephone" value="<?= $usager->telephone ?>">
    </div>

    <div class="form-group col-md-4">
        <label for="courriel">Courriel</label>
        <input type="text" class="form-control text-lowercase" id="courriel" name="courriel" value="<?= $usager->courriel ?>">
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-4">
        <label for="mot-de-passe">Mot de passe</label>
        <input type="password" class="form-control" id="mot-de-passe" name="mot-de-passe">
    </div>

    <div class="form-group col-md-4">
        <label for="confirm-mot-de-passe">Confirmer mot de passe</label>
        <input type="password" class="form-control" id="confirm-mot-de-passe" name="confirm-mot-de-passe">
    </div>

    <div class="form-group col-md-2">
        <label for="actif">Profil d'accès</label>
        <select class="form-control" name="actif">
            <?php if ($usager->id): ?>
                <option value="1" <?= ($usager->is_admin ? 'selected' : ''); ?>>Administrateur</option>
                <option value="0" <?= (!$usager->is_admin ? 'selected' : ''); ?>>Client</option>
            <?php else: ?>
                <option value="1">Administrateur</option>
                <option value="0" selected>Client</option>
            <?php endif; ?>
        </select>
    </div>

    <div class="form-group col-md-2">
        <label for="actif">Actif ? </label>
        <select class="form-control" name="actif">
            <?php if ($usager->id): ?>
                <option value="1" <?= ($usager->actif ? 'selected' : ''); ?>>Oui</option>
                <option value="0" <?= (!$usager->actif ? 'selected' : ''); ?>>Non</option>
            <?php else: ?>
                <option value="1">Oui</option>
                <option value="0" selected>Non</option>
            <?php endif; ?>
        </select>
    </div>

</div>
<div class="row">
    <button type="submit" class="btn btn-success mr-2 btn-sm">
        <i class="mdi mdi-content-save-outline btn-icon-prepend"></i>
        Enregistrer
    </button>

    <a href="<?= site_url("admin/users/show/$usager->id"); ?>" class="btn btn-info btn-sm">
        <i class="mdi mdi-arrow-left btn-icon-prepend"></i> Retourner
    </a>

</div>