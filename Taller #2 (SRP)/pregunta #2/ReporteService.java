import java.util.List;

// Clase para generar reportes de facturas
public class ReporteService {
    // Método para generar un reporte de facturas
    public void generarReporte(List<Factura> facturas) {
        System.out.println("Reporte de Facturas:");
        for (Factura factura : facturas) {
            System.out.println("Factura No: " + factura.getNumeroFactura());
            System.out.println("Fecha: " + factura.getFecha());
            System.out.println("Cliente: " + factura.getCliente());
            System.out.println("Monto Total: " + factura.getMontoTotal());
            System.out.println("Dirección: " + factura.getDireccion());
            System.out.println("--------------\n");
        }
    }
}
