import java.util.ArrayList;
import java.util.Date;
import java.util.List;

public class Pedido {
    private int id;
    private Date fecha;
    private Cliente cliente;
    private List<Producto> productos;

    public Pedido(int id, Date fecha, Cliente cliente) {
        this.id = id;
        this.fecha = fecha;
        this.cliente = cliente;
        this.productos = new ArrayList<>();
    }

    public void agregarProducto(Producto producto) {
        productos.add(producto);
    }

    // Getters and setters
    public int getId() {
        return id;
    }

    public Date getFecha() {
        return fecha;
    }

    public Cliente getCliente() {
        return cliente;
    }

    public List<Producto> getProductos() {
        return productos;
    }
}
