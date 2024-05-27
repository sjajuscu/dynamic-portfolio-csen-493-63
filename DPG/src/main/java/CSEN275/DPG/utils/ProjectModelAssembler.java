package CSEN275.DPG.utils;

import CSEN275.DPG.controller.PortfolioController;
import CSEN275.DPG.model.Project;
import org.springframework.hateoas.EntityModel;
import org.springframework.hateoas.server.RepresentationModelAssembler;
import org.springframework.lang.NonNull;
import org.springframework.stereotype.Component;

import static org.springframework.hateoas.server.mvc.WebMvcLinkBuilder.linkTo;
import static org.springframework.hateoas.server.mvc.WebMvcLinkBuilder.methodOn;

@Component
public class ProjectModelAssembler implements RepresentationModelAssembler<Project, EntityModel<Project>> {

    @NonNull
    @Override
    public EntityModel<Project> toModel(@NonNull Project entity) {
        return EntityModel.of(entity, linkTo(methodOn(PortfolioController.class).getAllProjects(entity.getPortfolio().getId())).withRel("projects"));
    }
}
