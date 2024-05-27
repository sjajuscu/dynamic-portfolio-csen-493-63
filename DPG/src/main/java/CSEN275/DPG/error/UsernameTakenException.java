package CSEN275.DPG.error;

public class UsernameTakenException extends RuntimeException {
    public UsernameTakenException(String username) {
        super("Username: '%s' has already been taken".formatted(username));
    }
}
