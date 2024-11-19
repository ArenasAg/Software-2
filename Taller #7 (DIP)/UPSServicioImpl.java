public class UPSServicioImpl implements IUPSEnvio {
    @Override
    public void enviarPorUPS(Orden orden) {
        System.out.println("Procesando envio a traves de UPS para la orden: " + orden);

        double tarifa = calcularTarifaUPS(orden);
        String etiqueta = imprimirEtiquetaUPS(orden);
        
        System.out.println("Tarifa calculada para UPS: $" + tarifa);
        System.out.println("Etiqueta generada: " + etiqueta);
    }

    private double calcularTarifaUPS(Orden orden) {
        double peso = 5.0;
        double tarifaPorKilo = 2.5;
        return peso * tarifaPorKilo;
    }

    private String imprimirEtiquetaUPS(Orden orden) {
        return "Etiqueta-UPS-12345";
    }
}
