import java.util.Date;

public class FabricaPedidos {
    public Pedido crearPedido(int id, Date fecha, Cliente cliente) {
        return new Pedido(id, fecha, cliente);
    }

    public Producto crearProducto(String nombre, double precio, int cantidad) {
        return new Producto(nombre, precio, cantidad);
    }

    public Cliente crearCliente(String nombre, String direccion) {
        return new Cliente(nombre, direccion);
    }
}