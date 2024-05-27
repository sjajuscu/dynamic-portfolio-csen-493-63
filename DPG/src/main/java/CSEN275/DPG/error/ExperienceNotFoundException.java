package CSEN275.DPG.error;

public class ExperienceNotFoundException extends RuntimeException {
    public ExperienceNotFoundException(Long id) {
        super("Could not find experience details with id=" + id);
    }
}
