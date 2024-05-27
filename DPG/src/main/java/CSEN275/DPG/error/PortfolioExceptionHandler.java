package CSEN275.DPG.error;

import org.springframework.http.HttpStatus;
import org.springframework.web.bind.annotation.ControllerAdvice;
import org.springframework.web.bind.annotation.ExceptionHandler;
import org.springframework.web.bind.annotation.ResponseBody;
import org.springframework.web.bind.annotation.ResponseStatus;

@ControllerAdvice
public class PortfolioExceptionHandler {

    @ResponseBody
    @ExceptionHandler(PortfolioNotFoundException.class)
    @ResponseStatus(HttpStatus.NOT_FOUND)
    String portfolioNotFoundHandler(PortfolioNotFoundException ex) {
        return ex.getMessage();
    }

    @ResponseBody
    @ExceptionHandler(PortfolioAlreadyExistsException.class)
    @ResponseStatus(HttpStatus.BAD_REQUEST)
    String portfolioAlreadyExistsHandler(PortfolioAlreadyExistsException ex) {
        return ex.getMessage();
    }

    @ResponseBody
    @ExceptionHandler(EducationNotFoundException.class)
    @ResponseStatus(HttpStatus.NOT_FOUND)
    String educationNotFoundHandler(EducationNotFoundException ex) {
        return ex.getMessage();
    }

    @ResponseBody
    @ExceptionHandler(ExperienceNotFoundException.class)
    @ResponseStatus(HttpStatus.NOT_FOUND)
    String experienceNotFoundHandler(ExperienceNotFoundException ex) {
        return ex.getMessage();
    }

    @ResponseBody
    @ExceptionHandler(ProjectNotFoundException.class)
    @ResponseStatus(HttpStatus.NOT_FOUND)
    String projectNotFoundHandler(ProjectNotFoundException ex) {
        return ex.getMessage();
    }
}
