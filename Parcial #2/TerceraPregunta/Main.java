package TerceraPregunta;


interface Factura {
    String getCodigo();
    double getTotal();
    Cliente getCliente();
}

class Cliente {
    private String identificacion;
    private String nombre;
    private String correo;
    
    public String getIdentificacion() {
        return identificacion;
    }

    public String getNombre() {
        return nombre;
    }

    public String getCorreo() {
        return correo;
    }

    public void setIdentificacion(String identificacion) {
        this.identificacion = identificacion;
    }

    public void setNombre(String nombre) {
        this.nombre = nombre;
    }

    public void setCorreo(String correo) {
        this.correo = correo;
    }

    public Cliente(String identificacion, String nombre, String correo) {
        this.identificacion = identificacion;
        this.nombre = nombre;
        this.correo = correo;
    }
}

class FacturaFisica implements Factura {
    private String codigo;
    private double total;
    private Cliente cliente;
    
    @Override
    public String getCodigo() {
        return codigo;
    }

    @Override
    public double getTotal() {
        return total;
    }

    @Override
    public Cliente getCliente() {
        return cliente;
    }
}

class FacturaElectronica implements Factura {
    private String codigo;
    private double total;
    private String numeroElectronico;
    private Cliente cliente;
    
    @Override
    public String getCodigo() {
        return codigo;
    }

    @Override
    public double getTotal() {
        return total;
    }

    @Override
    public Cliente getCliente() {
        return cliente;
    }
}

public class Main {
    public static void main(String[] args) {
        Factura facturaFisica = new FacturaFisica();
        Factura facturaElectronica = new FacturaElectronica();

        procesarFactura(facturaFisica);
        procesarFactura(facturaElectronica);
    }
    
    public static void procesarFactura(Factura factura) {
        System.out.println("Procesando factura con código: " + factura.getCodigo());
    }
}
