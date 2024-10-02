import java.util.Date;

public class Main {
    public static void main(String[] args) {
        FabricaPedidos fabrica = new FabricaPedidos();

        Cliente cliente = fabrica.crearCliente("Juan", "Cr 25");
        Pedido pedido = fabrica.crearPedido(1, new Date(), cliente);
        Producto producto1 = fabrica.crearProducto("Laptop", 1500.0, 1);
        Producto producto2 = fabrica.crearProducto("Mouse", 20.0, 2);

        pedido.agregarProducto(producto1);
        pedido.agregarProducto(producto2);

        System.out.println("Pedido ID: " + pedido.getId());
        System.out.println("Cliente: " + pedido.getCliente().getNombre());
        System.out.println("Productos:");
        for (Producto producto : pedido.getProductos()) {
            System.out.println("- " + producto.getNombre() + " x" + producto.getCantidad() + " $" + producto.getPrecio());
        }
    }
}