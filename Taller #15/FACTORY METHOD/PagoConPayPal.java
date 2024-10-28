class PagoConPayPal implements MetodoDePago {
    @Override
    public void procesarPago(double cantidad) {
        System.out.println("Procesando pago con PayPal de $" + cantidad);
    }
}