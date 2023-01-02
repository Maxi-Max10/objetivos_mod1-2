   <!-- 
    
   MODAL CONFIRMACION DE BAJA  OBJETIVO 
  
  -->

<div class="modal fade" id="Baja<?php echo $fila2["id_objetivo"]; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">¿Esta seguro que desea dar de baja objetivo?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
         <?php echo $fila2['nombre_objetivo']; ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <a href="baja_objetivo.php?id=<?php echo $fila2["id_objetivo"]; ?>"><button class="btn btn-danger">Sí, aceptar</button></a>
      </div>
    </div>
  </div>
</div>
   