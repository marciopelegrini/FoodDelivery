<div class="form-row">
    <div class="form-group col-md-4">
        <label for="nom">Nom</label>
        <input type="text" class="form-control" id="nom" name="nom" value="<?= old('nom', esc($usager->nom)) ?>">
    </div>

    <div class="form-group col-md-2">
        <label for="assurance_maladie">Ass. maladie</label>
        <input type="text" class="form-control assm text-uppercase" id="assurance_maladie" name="assurance_maladie"
               value="<?= old('assurance_maladie', esc($usager->assurance_maladie)) ?>">
    </div>

    <div class="form-group col-md-2">
        <label for="telephone">Téléphone</label>
        <input type="text" class="form-control phone" id="telephone" name="telephone"
               value="<?= old('telephone', esc($usager->telephone)) ?>">
    </div>

    <div class="form-group col-md-4">
        <label for="courriel">Courriel</label>
        <input type="text" class="form-control text-lowercase" id="courriel" name="courriel"
               value="<?= old('courriel', esc($usager->courriel)) ?>">
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-4">
        <label for="mot_de_passe">Mot de passe</label>
        <input type="password" class="form-control" id="mot_de_passe" name="mot_de_passe">
    </div>

    <div class="form-group col-md-4">
        <label for="confirm_mot_de_passe">Confirmer mot de passe</label>
        <input type="password" class="form-control" id="confirm_mot_de_passe" name="confirm_mot_de_passe">
    </div>
</div>

<div class="form-check form-check-flat form-check-primary mb-2">
    <label for="actif" class="form-check-label">
        <input type="hidden" name="actif" value="0">
        <input type="checkbox" class="form-check-input" id="actif" name="actif" value="1"
            <?php if (old('actif', $usager->actif)) : ?> checked="checked" <?php endif; ?>>Actif
    </label>
</div>

<div class="form-check form-check-flat form-check-primary mb-3">
    <label for="is_admin" class="form-check-label">
        <input type="hidden" name="is_admin" value="0">
        <input type="checkbox" class="form-check-input" id="is_admin" name="is_admin" value="1"
            <?php if (old('is_admin', $usager->is_admin)) : ?> checked="checked" <?php endif; ?>>Administrateur
    </label>
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