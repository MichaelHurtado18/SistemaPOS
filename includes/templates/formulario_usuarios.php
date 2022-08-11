<label> Nombre  </label>
<input type="text" name="nombre" class="form-control nombre" placeholder="Nombre Usuario" value="<?php echo s($usuarios->nombre) ?>">
<label> Correo  </label>
<input type="text" name="correo" class="form-control correo" placeholder="Correo Usuario" value="<?php echo s($usuarios->correo) ?>">
<label> Contraseña </label>
<input type="password" name="contra" class="form-control password" placeholder="Contraseña Usuario">
<label> Seleccione Rol </label>
<select class="form-control rol" name="rol">
    <option value="">--</option>
    <?php foreach ($roles as $rol) : ?>
        <option value="<?php echo $rol->id ?>"> <?php echo $rol->rol ?> </option>
    <?php endforeach; ?>
</select>
