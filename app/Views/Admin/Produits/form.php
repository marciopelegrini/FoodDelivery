<div class="form-row">
    <div class="form-group col-md-8">
        <label for="nom">Nom</label>
        <input type="text" class="form-control" id="nom" name="nom" value="<?= old('nom', esc($produit->nom)) ?>">
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-6">
        <select class="custom-select" name="categorie_id">
            <option value="">Choisir la catégorie</option>
            <?php foreach ($categories as $categorie): ?>
                <?php if ($produit->id): ?>
                    <option value="<?= $categorie->id ?>"
                        <?= ($categorie->id == $produit->categorie_id ? "selected" : "") ?> >
                        <?= $categorie->nom ?>
                    </option>
                <?php else: ?>
                    <option value="<?= $categorie->id ?>"> <?= $categorie->nom ?></option>
                <?php endif; ?>
            <?php endforeach; ?>
        </select>
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-8">
        <label for="ingredients">Ingrédients</label>
        <textarea class="form-control" rows="2" name="ingredients" id="ingredients"><?= old('ingredients', esc($produit->ingredients)) ?></textarea>
    </div>
</div>


<div class="form-check form-check-flat form-check-primary mb-4">
    <label for="actif" class="form-check-label">
        <input type="hidden" name="actif" value="0">
        <input type="checkbox" class="form-check-input" id="actif" name="actif" value="1"
            <?php if (old('actif', $produit->actif)) : ?> checked="checked" <?php endif; ?>>Actif
    </label>
</div>

<button type="submit" class="btn btn-success mr-2 btn-sm">
    <i class="mdi mdi-content-save-outline btn-icon-prepend"></i>
    Enregistrer
</button>
