import java.util.ArrayList;
import java.util.List;

// Clase para gestionar el almacenamiento de facturas
public class FacturaDAO {
    private List<Factura> facturas;

    // Constructor que inicializa la lista de facturas
    public FacturaDAO() {
        this.facturas = new ArrayList<>();
    }

    // Método para agregar una nueva factura
    public void agregarFactura(Factura factura) {
        facturas.add(factura);
    }

    // Método para listar todas las facturas
    public List<Factura> listarFacturas() {
        return new ArrayList<>(facturas);
    }
}