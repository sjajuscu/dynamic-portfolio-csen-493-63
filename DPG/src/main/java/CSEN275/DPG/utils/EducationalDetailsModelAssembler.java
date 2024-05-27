package CSEN275.DPG.utils;

import CSEN275.DPG.controller.PortfolioController;
import CSEN275.DPG.model.EducationalDetails;
import org.springframework.hateoas.EntityModel;
import org.springframework.hateoas.server.RepresentationModelAssembler;
import org.springframework.lang.NonNull;
import org.springframework.stereotype.Component;

import static org.springframework.hateoas.server.mvc.WebMvcLinkBuilder.linkTo;
import static org.springframework.hateoas.server.mvc.WebMvcLinkBuilder.methodOn;

@Component
public class EducationalDetailsModelAssembler implements RepresentationModelAssembler<EducationalDetails, EntityModel<EducationalDetails>> {

    @NonNull
    @Override
    public EntityModel<EducationalDetails> toModel(@NonNull EducationalDetails entity) {
        return EntityModel.of(entity,
                linkTo(methodOn(PortfolioController.class).getAllEducations(entity.getPortfolio().getId())).withRel("educations"));
    }
}
