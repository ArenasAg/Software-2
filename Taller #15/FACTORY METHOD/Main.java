public class Main {
    public static void main(String[] args) {
        CreadorDePago creadorDeTarjeta = new CreadorDePagoConTarjeta();
        MetodoDePago pagoConTarjeta = creadorDeTarjeta.crearMetodoDePago();
        pagoConTarjeta.procesarPago(100.0);

        CreadorDePago creadorDePayPal = new CreadorDePagoConPayPal();
        MetodoDePago pagoConPayPal = creadorDePayPal.crearMetodoDePago();
        pagoConPayPal.procesarPago(200.0);
    }
}