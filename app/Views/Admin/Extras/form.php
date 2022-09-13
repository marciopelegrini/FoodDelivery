<div class="form-row">
    <div class="form-group col-md-8">
        <label for="nom">Nom</label>
        <input type="text" class="form-control" id="nom" name="nom" value="<?= old('nom', esc($extra->nom)) ?>">
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-8">
        <label for="prix">Prix $</label>
        <input type="text" class="money form-control" id="prix" name="prix" value="<?= old('prix', esc($extra->prix)) ?>">
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-8">
        <label for="description">Description</label>
        <textarea class="form-control" rows="2" name="description" id="description"><?= old('description', esc($extra->description)) ?></textarea>
    </div>
</div>

<div class="form-check form-check-flat form-check-primary mb-4">
    <label for="actif" class="form-check-label">
        <input type="hidden" name="actif" value="0">
        <input type="checkbox" class="form-check-input" id="actif" name="actif" value="1"
            <?php if (old('actif', $extra->actif)) : ?> checked="checked" <?php endif; ?>>Actif
    </label>
</div>

<button type="submit" class="btn btn-success mr-2 btn-sm">
    <i class="mdi mdi-content-save-outline btn-icon-prepend"></i>
    Enregistrer
</button>
