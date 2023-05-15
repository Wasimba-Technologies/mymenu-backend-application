import { AbilityBuilder, createMongoAbility,  } from '@casl/ability'

const { build } = new AbilityBuilder(createMongoAbility);

export default build();

