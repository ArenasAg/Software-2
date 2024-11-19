public class Main {
    public static void main(String[] args) {

        Usuario usuarioGmail = new Usuario("Alejo", "123474545");
        Usuario usuarioOutlook = new Usuario("Manuela", "23525473");

        ICanalNotificacion servicioGmail = new CanalGmail();
        GeneradorCorreo generarGmail = new GeneradorCorreo(servicioGmail);
        generarGmail.generarCorreo(usuarioGmail);
    


        ICanalNotificacion servicioOutlook = new CanalOutlook();
        GeneradorCorreo generarOutlook = new GeneradorCorreo(servicioOutlook);
        generarOutlook.generarCorreo(usuarioOutlook);
    }
}