class PaquetePequenoImpl implements PaquetePequeno {
    private double peso;
    private String dimensiones;
    private double valorDeclarado;

    public PaquetePequenoImpl(double peso, String dimensiones, double valorDeclarado) {
        this.peso = peso;
        this.dimensiones = dimensiones;
        this.valorDeclarado = valorDeclarado;
    }

    @Override
    public void calcularCostoEnvio() {
        double costo = peso * 2;
        System.out.println("Costo de envío para paquete pequeño: " + costo);
    }

    @Override
    public void verificarContenido() {

        if (dimensiones != null && !dimensiones.isEmpty()) {
            System.out.println("Contenido del paquete pequeño verificado y es seguro.");
        } else {
            System.out.println("Las dimensiones del paquete pequeño no son válidas.");
        }
    }

    @Override
    public void calcularCostoEnvioPequeño() {
        calcularCostoEnvio();
    }

    @Override
    public void verificarValorDeclarado() {
        if (valorDeclarado > 0) {
            System.out.println("Valor declarado del paquete pequeño: " + valorDeclarado);
        } else {
            System.out.println("El valor declarado no es válido.");
        }
    }
}