import java.util.Date;


// Clase principal que contiene el método main
public class Main {
    public static void main(String[] args) {
        // Crear instancias de Factura y Cliente
        Factura factura = new Factura("#1", new Date(), "Anderson Arenas", 1234.56, "cLL 25A");
        Cliente cliente = new Cliente("Anderson Arenas", "Crr 33", "3195481532", "anderson.arenas@autonoma.edu.co");

        // Instanciar las clases de gestión
        FacturaDAO guardarFactura = new FacturaDAO();
        EmailService emailService = new EmailService();
        ClienteDAO clienteDAO = new ClienteDAO();
        ReporteService reporteService = new ReporteService();

        // Agregar y almacenar facturas y clientes
        guardarFactura.agregarFactura(factura);
        clienteDAO.agregarCliente(cliente);

        // Enviar factura por email
        emailService.enviarEmailFactura(factura, cliente.getCorreoElectronico());

        // Enviar factura a la DIAN
        emailService.enviarFacturaDian(factura);

        // Generar reporte de facturas
        reporteService.generarReporte(guardarFactura.listarFacturas());
    }
}




