package CSEN275.DPG.error;

public class PortfolioAlreadyExistsException extends RuntimeException {
    public PortfolioAlreadyExistsException (Long userId) {
        super("Portfolio already exists for user with user id: " + userId);
    }
}
