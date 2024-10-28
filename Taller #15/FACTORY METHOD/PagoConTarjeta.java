class PagoConTarjeta implements MetodoDePago {
    @Override
    public void procesarPago(double cantidad) {
        System.out.println("Procesando pago con tarjeta de $" + cantidad);
    }
}