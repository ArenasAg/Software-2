public class Main {
    public static void main(String[] args) {
        Entrada entrada1 = new Entrada("VIP", 100, true);

        Usuario usuario = new Usuario();
        usuario.agregarEntrada(entrada1);
        usuario.comprar("VIP");
    }
}
