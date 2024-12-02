package Segunda_pregunta;

public class Main {
    public static void main(String[] args) {
        Hamburguesa hamburguesa = new Hamburguesa.Builder()
                .setTipoTomate("Tomate Cherry")
                .setTipoCarne("Carne de Res")
                .setTipoQueso("Queso Cheddar")
                .setTipoPan("Pan Brioche")
                .build();

        System.out.println(hamburguesa);
    }
}
