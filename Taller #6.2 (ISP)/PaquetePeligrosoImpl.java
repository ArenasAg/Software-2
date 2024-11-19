class PaquetePeligrosoImpl implements PaquetePeligroso {
    private double peso;
    private String dimensiones;
    private String etiquetasDePeligro;
    private boolean embalajeEspecial;

    public PaquetePeligrosoImpl(double peso, String dimensiones, String etiquetasDePeligro, boolean embalajeEspecial) {
        this.peso = peso;
        this.dimensiones = dimensiones;
        this.etiquetasDePeligro = etiquetasDePeligro;
        this.embalajeEspecial = embalajeEspecial;
    }

    @Override
    public void calcularCostoEnvio() {
        double costo = peso * 5;
        System.out.println("Costo de envío para paquete peligroso: " + costo);
    }

    @Override
    public void verificarContenido() {
        if (dimensiones != null && !dimensiones.isEmpty()) {
            System.out.println("Dimensiones del paquete peligroso verificadas: " + dimensiones);
        } else {
            System.out.println("Las dimensiones del paquete peligroso no son válidas.");
        }

        if (etiquetasDePeligro != null && !etiquetasDePeligro.isEmpty()) {
            System.out.println("Contenido del paquete peligroso verificado con etiquetas de peligro.");
        } else {
            System.out.println("Faltan etiquetas de peligro en el paquete peligroso.");
        }
    }

    @Override
    public void verificarEtiquetasDePeligro() {
        if (etiquetasDePeligro.equalsIgnoreCase("Inflamable") || etiquetasDePeligro.equalsIgnoreCase("Tóxico")) {
            System.out.println("Etiquetas de peligro verificadas: " + etiquetasDePeligro);
        } else {
            System.out.println("Las etiquetas de peligro no son adecuadas.");
        }
    }

    @Override
    public void asegurarEmbalajeEspecial() {
        if (embalajeEspecial) {
            System.out.println("Embalaje especial asegurado para el paquete peligroso.");
        } else {
            System.out.println("Se requiere embalaje especial para el paquete peligroso.");
        }
    }
}