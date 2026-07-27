<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/sisventas/vista/layout/header.php";


include_once "../../modelo/cliente.php";
include_once "../../modelo/producto.php";

$objCli = new Cliente();
$clientes = $objCli->listado();

$objProd = new Producto();
$productos = $objProd->listado();
?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-cash-register"></i> Registrar Nueva Venta</h5>
                </div>
                <div class="card-body">
                    <form action="grabar.php" method="POST">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Seleccionar Cliente:</label>
                                <select name="idcliente" class="form-select" required>
                                    <option value="">-- Seleccione Cliente --</option>
                                    <?php foreach ($clientes as $c) { ?>
                                        <option value="<?php echo $c['idcliente']; ?>"><?php echo $c['nombre']; ?> (DNI/RUC: <?php echo $c['dni']; ?>)</option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Tipo de Pago:</label>
                                <select name="tipo_pago" class="form-select" required>
                                    <option value="Contado">Al Contado</option>
                                    <option value="Crédito">A Crédito</option>
                                </select>
                            </div>
                        </div>

                        <hr>
                        <h6 class="text-primary mb-3"><i class="fas fa-boxes"></i> Agregar Producto a la Venta</h6>
                        
                        <div class="row mb-3 align-items-end">
                            <div class="col-md-6">
                                <label class="form-label">Producto:</label>
                                <select id="select_producto" class="form-select">
                                    <option value="">-- Seleccione Producto --</option>
                                    <?php foreach ($productos as $p) { ?>
                                        <option value="<?php echo $p['idproducto']; ?>" data-precio="<?php echo $p['preuni']; ?>" data-stock="<?php echo $p['stock']; ?>">
                                            <?php echo $p['nomproducto']; ?> (Stock: <?php echo $p['stock']; ?> - P.U: $<?php echo $p['preuni']; ?>)
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Cantidad:</label>
                                <input type="number" id="txt_cantidad" class="form-control" value="1" min="1">
                            </div>
                            <div class="col-md-3">
                                <button type="button" class="btn btn-primary w-100" onclick="agregarAlCarrito()">
                                    <i class="fas fa-plus"></i> Agregar
                                </button>
                            </div>
                        </div>

                        <!-- Tabla temporal del carrito -->
                        <div class="table-responsive mb-3">
                            <table class="table table-bordered text-center align-middle" id="tabla_carrito">
                                <thead class="table-secondary">
                                    <tr>
                                        <th>Producto</th>
                                        <th>Precio U.</th>
                                        <th>Cantidad</th>
                                        <th>Subtotal</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="5" class="text-muted">No hay productos agregados aún.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <h4>Total a Pagar: $<span id="lbl_total">0.00</span></h4>
                            <input type="hidden" name="total_venta" id="input_total" value="0">
                            <input type="hidden" name="detalle_json" id="input_detalle">
                            <div>
                                <a href="listado.php" class="btn btn-secondary">Cancelar</a>
                                <button type="submit" class="btn btn-success" id="btn_procesar" disabled>
                                    <i class="fas fa-check-circle"></i> Procesar Venta
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script dinámico para el carrito de compras en la vista -->
<script>
let carrito = [];

function agregarAlCarrito() {
    let select = document.getElementById('select_producto');
    let opt = select.options[select.selectedIndex];
    
    if(!select.value) {
        alert("Seleccione un producto válido.");
        return;
    }

    let idproducto = select.value;
    let nombre = opt.text.split(' (')[0];
    let precio = parseFloat(opt.getAttribute('data-precio'));
    let stock = parseInt(opt.getAttribute('data-stock'));
    let cantidad = parseInt(document.getElementById('txt_cantidad').value);

    if(cantidad > stock) {
        alert("La cantidad supera el stock disponible (" + stock + ").");
        return;
    }

    // Verificar si ya está agregado
    let index = carrito.findIndex(item => item.idproducto === idproducto);
    if(index !== -1) {
        carrito[index].cantidad += cantidad;
    } else {
        carrito.push({ idproducto, nombre, precio, cantidad });
    }

    actualizarTablaCarrito();
}

function eliminarDelCarrito(index) {
    carrito.splice(index, 1);
    actualizarTablaCarrito();
}

function actualizarTablaCarrito() {
    let tbody = document.querySelector('#tabla_carrito tbody');
    tbody.innerHTML = '';
    let totalGeneral = 0;

    if(carrito.length === 0) {
        tbody.innerHTML = `<tr><td colspan="5" class="text-muted">No hay productos agregados aún.</td></tr>`;
        document.getElementById('lbl_total').innerText = '0.00';
        document.getElementById('input_total').value = '0';
        document.getElementById('input_detalle').value = '';
        document.getElementById('btn_procesar').disabled = true;
        return;
    }

    carrito.forEach((item, index) => {
        let subtotal = item.precio * item.cantidad;
        totalGeneral += subtotal;

        tbody.innerHTML += `
            <tr>
                <td>${item.nombre}</td>                 <td>$${item.precio.toFixed(2)}</td>
                <td>${item.cantidad}</td>                 <td>$${subtotal.toFixed(2)}</td>
                <td><button type="button" class="btn btn-danger btn-sm" onclick="eliminarDelCarrito(${index})"><i class="fas fa-trash"></i></button></td>
            </tr>
        `;
    });

    document.getElementById('lbl_total').innerText = totalGeneral.toFixed(2);
    document.getElementById('input_total').value = totalGeneral.toFixed(2);
    document.getElementById('input_detalle').value = JSON.stringify(carrito);
    document.getElementById('btn_procesar').disabled = false;
}
</script>

<?php include_once $_SERVER['DOCUMENT_ROOT'] . "/sisventas/vista/layout/footer.php"; ?>