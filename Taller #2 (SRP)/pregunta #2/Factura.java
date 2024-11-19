import java.util.Date;

//Clase que representa una factura
public class Factura {
    private String numeroFactura;
    private Date fecha;
    private String cliente;
    private double montoTotal;
    private String direccion;

    // Constructor
    public Factura(String numeroFactura, Date fecha, String cliente, double montoTotal, String direccion) {
        this.numeroFactura = numeroFactura;
        this.fecha = fecha;
        this.cliente = cliente;
        this.montoTotal = montoTotal;
        this.direccion = direccion;
    }

    // Getters y setters para cada campo
    public String getNumeroFactura() { return numeroFactura; }
    public void setNumeroFactura(String numeroFactura) { this.numeroFactura = numeroFactura; }
    public Date getFecha() { return fecha; }
    public void setFecha(Date fecha) { this.fecha = fecha; }
    public String getCliente() { return cliente; }
    public void setCliente(String cliente) { this.cliente = cliente; }
    public double getMontoTotal() { return montoTotal; }
    public void setMontoTotal(double montoTotal) { this.montoTotal = montoTotal; }
    public String getDireccion() { return direccion; }
    public void setDireccion(String direccion) { this.direccion = direccion; }
}
