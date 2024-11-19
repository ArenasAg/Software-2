class PaqueteGrandeImpl implements PaqueteGrande {
    private double peso;
    private String dimensiones;
    private double volumen;
    private String medioTransporte;

    public PaqueteGrandeImpl(double peso, String dimensiones, double volumen, String medioTransporte) {
        this.peso = peso;
        this.dimensiones = dimensiones;
        this.volumen = volumen;
        this.medioTransporte = medioTransporte;
    }

    @Override
    public void calcularCostoEnvio() {
        double costo = peso * 3 + volumen * 1.5;
        System.out.println("Costo de envío para paquete grande: " + costo);
    }

    @Override
    public void verificarContenido() {
        if (dimensiones != null && !dimensiones.isEmpty()) {
            System.out.println("Contenido del paquete grande verificado y es seguro.");
        } else {
            System.out.println("Las dimensiones del paquete grande no son válidas.");
        }
    }

    @Override
    public void calcularCostoEnvioGrande() {
        calcularCostoEnvio();
    }

    @Override
    public void verificarMedioTransporte() {
        if (medioTransporte.equalsIgnoreCase("Aéreo") || medioTransporte.equalsIgnoreCase("Terrestre")) {
            System.out.println("Medio de transporte para paquete grande es adecuado: " + medioTransporte);
        } else {
            System.out.println("Medio de transporte no válido para el paquete grande.");
        }
    }
}