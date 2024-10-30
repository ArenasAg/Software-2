package PrimerPregunta.DRY;

public class Main {
    public static void main(String[] args) {
        Orden orden = new Orden();
        Double totalImpuesto = orden.calcularTotalConImpuesto(20000);
        Double totalDescuento = orden.calcularDescuentoTotal(totalImpuesto, 0.5);
        System.out.println("Total con descuento: " + totalDescuento);
    }
}

class Orden {
    public double calcularTotalConImpuesto(double precio) {
        double impuesto = calcularDescuento(precio);
        return precio + impuesto;
    }

    public double calcularDescuentoTotal(double precio, double descuento) {
        double descuentoPrecio = precio - descuento;
        double impuesto = calcularDescuento(descuentoPrecio);
        return descuentoPrecio + impuesto;
    }

    public double calcularDescuento(double valor){
        return valor * 0.1;
    }
}