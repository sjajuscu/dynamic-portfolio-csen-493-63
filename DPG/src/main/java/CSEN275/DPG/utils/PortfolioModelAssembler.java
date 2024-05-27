package CSEN275.DPG.utils;

import CSEN275.DPG.controller.PortfolioController;
import CSEN275.DPG.model.Portfolio;
import org.springframework.hateoas.EntityModel;
import org.springframework.hateoas.server.RepresentationModelAssembler;
import org.springframework.lang.NonNull;
import org.springframework.stereotype.Component;

import static org.springframework.hateoas.server.mvc.WebMvcLinkBuilder.linkTo;
import static org.springframework.hateoas.server.mvc.WebMvcLinkBuilder.methodOn;

@Component
public class PortfolioModelAssembler implements RepresentationModelAssembler<Portfolio, EntityModel<Portfolio>> {

    @Override
    @NonNull
    public EntityModel<Portfolio> toModel(@NonNull Portfolio entity) {
        return EntityModel.of(entity,
                linkTo(methodOn(PortfolioController.class).one(entity.getId())).withSelfRel());
    }
}
