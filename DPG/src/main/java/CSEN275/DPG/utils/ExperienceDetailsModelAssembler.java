package CSEN275.DPG.utils;

import CSEN275.DPG.controller.PortfolioController;
import CSEN275.DPG.model.ExperienceDetails;
import org.springframework.hateoas.EntityModel;
import org.springframework.hateoas.server.RepresentationModelAssembler;
import org.springframework.lang.NonNull;
import org.springframework.stereotype.Component;

import static org.springframework.hateoas.server.mvc.WebMvcLinkBuilder.linkTo;
import static org.springframework.hateoas.server.mvc.WebMvcLinkBuilder.methodOn;

@Component
public class ExperienceDetailsModelAssembler implements RepresentationModelAssembler<ExperienceDetails, EntityModel<ExperienceDetails>> {

    @NonNull
    @Override
    public EntityModel<ExperienceDetails> toModel(@NonNull ExperienceDetails entity) {
        return EntityModel.of(entity,
                linkTo(methodOn(PortfolioController.class).getAllExperiences(entity.getPortfolio().getId())).withRel("experiences"));
    }
}
