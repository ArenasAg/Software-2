public class PasswordValidator {
    public boolean validatePassword(String password) {
        return password.length() >= 4; // Minimo 4 caracteres para ser válida
    }
}
