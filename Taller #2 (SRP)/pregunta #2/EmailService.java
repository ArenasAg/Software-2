// Clase para gestionar el envío de facturas por email
public class EmailService {
    // Método para enviar un email con la factura
    public void enviarEmailFactura(Factura factura, String correoDestinatario) {
        // Simulación de envío de correo
        System.out.println("Enviando email a: " + correoDestinatario);
        System.out.println("Asunto: Factura " + factura.getNumeroFactura());
        System.out.println("Contenido del email:\n" +
                "Factura No: " + factura.getNumeroFactura() + "\n" +
                "Fecha: " + factura.getFecha() + "\n" +
                "Cliente: " + factura.getCliente() + "\n" +
                "Monto Total: " + factura.getMontoTotal() + "\n" +
                "Dirección: " + factura.getDireccion());
        System.out.println("Email enviado exitosamente. \n");
    }

    // Método para enviar la factura a la DIAN
    public void enviarFacturaDian(Factura factura) {
        // Simulación de envío de factura a la DIAN
        System.out.println("Enviando factura a la DIAN:");
        System.out.println("Factura No: " + factura.getNumeroFactura());
        System.out.println("Fecha: " + factura.getFecha());
        System.out.println("Cliente: " + factura.getCliente());
        System.out.println("Monto Total: " + factura.getMontoTotal());
        System.out.println("Dirección: " + factura.getDireccion());
        System.out.println("Factura enviada exitosamente a la DIAN.\n");
    }
    
}