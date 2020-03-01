describe('When a marker is clicked, the informations should appear', () => {
    it('visit the / url', () => {
      cy.visit('/');
      cy.wait(1000);
      cy.get('.mgl-map-wrapper').should('be.visible');
      cy.get('.mapboxgl-canvas').should('be.visible');
      cy.get('.mapboxgl-marker.mapboxgl-marker-anchor-center').first().click({force: true});
      cy.get('.card.infocard.mb-2').should('be.visible');
      expect(cy.get('.adr')).to.not.equal('')
      expect(cy.get('.statut')).to.not.equal('')
      expect(cy.get('.tarif')).to.not.equal('')
    })
  })
  